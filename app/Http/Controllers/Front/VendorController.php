<?php

namespace App\Http\Controllers\Front;

use App\Classes\YiwuMailer;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Session;

class VendorController extends Controller
{

    public function index(Request $request,$slug)
    {
        $this->code_image();
        // $sort = "";
        $minprice = $request->min;
        $maxprice = $request->max;
        $sort = $request->sort;

        $vendor = User::where('shop_name','=',$slug)->firstOrFail();
        $data['vendor'] = $vendor;
        $data['services'] = DB::table('services')->where('user_id','=',$vendor->id)->get();
        // $oldcats = $vendor->products()->where('status','=',1)->orderBy('id','desc')->get();
        // $vprods = (new Collection(Product::filterProducts($oldcats)))->paginate(9);

        // Search By Price
        $vprods = Product::
        when(empty($sort), function ($query, $sort) {
            return $query->orderBy('id', 'DESC');
        })->where('status', 1)->where('user_id', $vendor->id)->paginate(10);
        $data['vprods'] = $vprods;
        return view('front.vendor', $data);
    }

    //Send email to user
    public function vendorcontact(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $vendor = User::findOrFail($request->vendor_id);
        $gs = Generalsetting::findOrFail(1);
        $subject = $request->subject;
        $to = $vendor->email;
        $name = $request->name;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
        if($gs->is_smtp)
        {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new YiwuMailer();
            $mailer->sendCustomMail($data);
        }
        else{
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }


        $conv = Conversation::where('sent_user','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new Message();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->sent_user = $user->id;
            $msg->save();
        }
        else{
            $message = new Conversation();
            $message->subject = $subject;
            $message->sent_user= $request->user_id;
            $message->recieved_user = $request->vendor_id;
            $message->message = $request->message;
            $message->save();
            $msg = new Message();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->sent_user = $request->user_id;;
            $msg->save();

        }
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = public_path().'/';
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }

    public function stores(Request $request, $slug=null, $slug1=null, $slug2=null){

        $cat = null;
        $subcat = null;
        $childcat = null;
        $sort = $request->sort;
        $search = $request->search;

        if (!empty($slug)) {
            $cat = Category::where('slug', $slug)->firstOrFail();
            $data['cat'] = $cat;
        }
        if (!empty($slug1)) {
            $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
            $data['subcat'] = $subcat;
        }
        if (!empty($slug2)) {
            $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
            $data['childcat'] = $childcat;
        }

        $vendors = User::where('status','=','1')->where('ban','=','0')->where('is_vendor','=','1')->leftJoin('vendor_categories','vendor_categories.user_id','=','users.id')
            ->when($cat, function ($query, $cat) {

                return $query->where('vendor_categories.category_id', $cat->id)->where('category_type','Main Category');
            })
            ->when($subcat, function ($query, $subcat) {

                return $query->where('vendor_categories.category_id', $subcat->id)->where('category_type','Sub Category');
            })
            ->when($childcat, function ($query, $childcat) {

                return $query->where('vendor_categories.category_id', $childcat->id)->where('category_type','Child Category');
            })
            ->when($search, function ($query, $search) {

                return $query->where('users.name', 'LIKE' , '%'.$search.'%');
            })
            ->when($sort, function ($query, $sort) {

                return $query->orderBy('users.name', 'DESC');
            })
            ->when(empty($sort), function ($query, $sort) {
                return $query->orderBy('users.name', 'ASC');
            });

        $vendors = $vendors->groupBy('vendor_categories.user_id')->paginate(12);
        $data['counties_code'] = Countries::pluck('country_code','country_name')->toArray();
        //debug($vendors,1);
        $data['vendors'] = $vendors;
        if($request->ajax()) {
            $data['ajax_check'] = 1;
            return view('includes.vendor.filtered-vendors', $data);
        }
        $data['page_title'] = 'Suppliers';
        $data['active_tab'] = 'suppliers';
        return view('front.suppliers', $data);

    }

}
