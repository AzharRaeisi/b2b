<?php

namespace App\Http\Controllers\Front;

use App\Classes\YiwuMailer;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Childcategory;
use App\Models\Counter;
use App\Models\Countries;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Pagesetting;
use App\Models\Partner;
use App\Models\Product;
use App\Models\QuoteCategory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Category;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Markury\MarkuryPost;

use Validator;

class FrontendController extends Controller
{
    public function __construct(){

        //$this->auth_guests();
        if(isset($_SERVER['HTTP_REFERER'])){
            $referral = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            if ($referral != $_SERVER['SERVER_NAME']){

                $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
                if($brwsr->count() > 0){
                    $brwsr = $brwsr->first();
                    $tbrwsr['total_count']= $brwsr->total_count + 1;
                    $brwsr->update($tbrwsr);
                }else{
                    $newbrws = new Counter();
                    $newbrws['referral']= $this->getOS();
                    $newbrws['type']= "browser";
                    $newbrws['total_count']= 1;
                    $newbrws->save();
                }

                $count = Counter::where('referral',$referral);
                if($count->count() > 0){
                    $counts = $count->first();
                    $tcount['total_count']= $counts->total_count + 1;
                    $counts->update($tcount);
                }else{
                    $newcount = new Counter();
                    $newcount['referral']= $referral;
                    $newcount['total_count']= 1;
                    $newcount->save();
                }
            }
        }else{
            $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
            if($brwsr->count() > 0){
                $brwsr = $brwsr->first();
                $tbrwsr['total_count']= $brwsr->total_count + 1;
                $brwsr->update($tbrwsr);
            }else{
                $newbrws = new Counter();
                $newbrws['referral']= $this->getOS();
                $newbrws['type']= "browser";
                $newbrws['total_count']= 1;
                $newbrws->save();
            }
        }
    }

    function getOS() {

        $user_agent     =   !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Unknown";

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }

        }
        return $os_platform;
    }


// -------------------------------- HOME PAGE SECTION ----------------------------------------



    function index(){

        $ps         = Pagesetting::find(1);
        $sliders    = Slider::where('use_for','=','Website')->get();
        $partners   = Partner::get();
        $services   = Service::orderBy('id','DESC')->where('user_id','=',0)->get();
        $discount_products =  Product::where('is_discount','=',1)->where('status','=',1)->where('discount_date','>=',Carbon::now())->with('ratings')->orderBy('id','desc')->take(28)->get();


        $category_selections = Category::where('is_featured','=','1')->orderBy('feature_sort_order','ASC')->take(10)->get()->map(function ($query) {
            $query->setRelation('products', $query->products->take(7));
            return $query;
        });
        $botom_baner = DB::table('banners')->where('type','=','BottomSmall')->first();
        $getquote_baner = DB::table('banners')->where('type','=','BottomSmall')->skip(1)->first();
        $marketplace_baner = DB::table('banners')->where('type','=','TopSmall')->skip(1)->first();
        $selectable = ['id','user_id','name','slug','features','details','colors','thumbnail','price','previous_price','attributes','size','size_price','discount_date'];
        $feature_product =  Product::where('featured','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->first();
        $gs = Generalsetting::findOrFail(1);
        $buyer_requests = Quote::where('status','=','Approved')->orderBy('id','desc')->with('main_categories','sub_categories','child_categories','country_info')->limit(10)->get()->toArray();

        $main_cat   = [];
        $sub_cat    = [];
        $child_cat  = [];
        foreach ($buyer_requests as $buyer_request){
            $main_categories = $buyer_request['main_categories'];
            foreach ($main_categories as $category){
                $main_cat[] = $category['cat_id'];
            }
            $sub_categories = $buyer_request['sub_categories'];
            foreach ($sub_categories as $category){
                $sub_cat[] = $category['cat_id'];
            }
            $child_categories = $buyer_request['child_categories'];
            foreach ($child_categories as $category){
                $child_cat[] = $category['cat_id'];
            }
        }
        $main_categories_info = Category::whereIn('id',$main_cat)->pluck('name','id')->toArray();
        $sub_categories_info = Subcategory::whereIn('id',$sub_cat)->pluck('name','id')->toArray();
        $child_categories_info = Childcategory::whereIn('id',$child_cat)->pluck('name','id')->toArray();

        return view('front.home', compact('ps','services','partners','discount_products','category_selections','sliders','feature_product','botom_baner','buyer_requests','main_categories_info','sub_categories_info','child_categories_info','getquote_baner','marketplace_baner'));
    }

    public function extraIndex()
    {
        $services = DB::table('services')->where('user_id','=',0)->get();
        $bottom_small_banners = DB::table('banners')->where('type','=','BottomSmall')->get();
        $large_banners = DB::table('banners')->where('type','=','Large')->get();
        $reviews =  DB::table('reviews')->get();
        $ps = DB::table('pagesettings')->find(1);
        $partners = DB::table('partners')->get();
        $selectable = ['id','user_id','name','slug','features','colors','thumbnail','price','previous_price','attributes','size','size_price','discount_date'];
        $discount_products =  Product::where('is_discount','=',1)->where('status','=',1)->orderBy('id','desc')->take(8)->get();
        $best_products = Product::where('best','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();
        $top_products = Product::where('top','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(8)->get();;
        $big_products = Product::where('big','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();;
        $hot_products =  Product::where('hot','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        $latest_products =  Product::where('latest','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        $trending_products =  Product::where('trending','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        $sale_products =  Product::where('sale','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
        return view('front.extraindex',compact('ps','services','reviews','large_banners','bottom_small_banners','best_products','top_products','hot_products','latest_products','big_products','trending_products','sale_products','discount_products','partners'));
    }

// -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------


// LANGUAGE SECTION
    public function language($id){
        $this->code_image();
        Session::put('language', $id);

        return redirect()->back();
    }

// LANGUAGE SECTION ENDS


// CURRENCY SECTION

    public function currency($id)
    {
        $this->code_image();
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', $id);
        return redirect()->back();
    }

// CURRENCY SECTION ENDS

    public function autosearch($slug)
    {
        if(mb_strlen($slug,'utf-8') > 1){
            $search = ' '.$slug;
            $prods = Product::where('status','=',1)->where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->take(10)->get()->reject(function($item){

                if($item->user_id != 0){
                    if($item->user->is_vendor != 2){
                        return true;
                    }
                }
                return false;
            });

            return view('load.suggest',compact('prods','slug'));
        }
        return "";
    }


// -------------------------------- BLOG SECTION ----------------------------------------

    public function blog(Request $request)
    {
        $this->code_image();
        $blogs = Blog::orderBy('created_at','desc')->paginate(9);
        if($request->ajax()){
            return view('front.pagination.blog',compact('blogs'));
        }
        return view('front.blog',compact('blogs'));
    }

    public function blogcategory(Request $request, $slug)
    {
        $this->code_image();
        $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(9);
        if($request->ajax()){
            return view('front.pagination.blog',compact('blogs'));
        }
        return view('front.blog',compact('bcat','blogs'));
    }

    public function blogtags(Request $request, $slug)
    {
        $this->code_image();
        $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(9);
        if($request->ajax()){
            return view('front.pagination.blog',compact('blogs'));
        }
        return view('front.blog',compact('blogs','slug'));
    }

    public function blogsearch(Request $request)
    {
        $this->code_image();
        $search = $request->search;
        $blogs = Blog::where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->paginate(9);
        if($request->ajax()){
            return view('front.pagination.blog',compact('blogs'));
        }
        return view('front.blog',compact('blogs','search'));
    }

    public function blogarchive(Request $request,$slug)
    {
        $this->code_image();
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
        if($request->ajax()){
            return view('front.pagination.blog',compact('blogs'));
        }
        return view('front.blog',compact('blogs','date'));
    }

    public function blogshow($id)
    {
        $this->code_image();
        $tags = null;
        $tagz = '';
        $bcats = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        $blog->views = $blog->views + 1;
        $blog->update();
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $blog_meta_tag = $blog->meta_tag;
        $blog_meta_description = $blog->meta_description;
        return view('front.blogshow',compact('blog','bcats','tags','archives','blog_meta_tag','blog_meta_description'));
    }


// -------------------------------- BLOG SECTION ENDS----------------------------------------



// -------------------------------- FAQ SECTION ----------------------------------------
    public function faq()
    {
        $this->code_image();
        if(DB::table('generalsettings')->find(1)->is_faq == 0){
            return redirect()->back();
        }
        $faqs =  DB::table('faqs')->orderBy('id','desc')->get();
        return view('front.faq',compact('faqs'));
    }
// -------------------------------- FAQ SECTION ENDS----------------------------------------


// -------------------------------- PAGE SECTION ----------------------------------------
    public function page($slug)
    {
        if($slug == 'faq'){
            return redirect()->to(route('front.faq'));
        }
        if($slug == 'contact'){
            return redirect()->to(route('front.contact'));
        }
        $this->code_image();
        $page =  DB::table('pages')->where('slug',$slug)->first();
        if(empty($page)) {
            return response()->view('errors.404')->setStatusCode(404);
        }

        return view('front.page',compact('page'));
    }
// -------------------------------- PAGE SECTION ENDS----------------------------------------


// -------------------------------- CONTACT SECTION ----------------------------------------
    public function contact()
    {
        $this->code_image();
        if(DB::table('generalsettings')->find(1)->is_contact== 0){
            return redirect()->back();
        }
        $ps =  DB::table('pagesettings')->where('id','=',1)->first();
        return view('front.contact',compact('ps'));
    }


    //Send email to admin
    public function contactemail(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_capcha == 1)
        {

            // Capcha Check
            $value = session('captcha_string');
            if ($request->codes != $value){
                return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));
            }

        }

        // Login Section
        $ps = DB::table('pagesettings')->where('id','=','1')->first();
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$phone."\nMessage: ".$request->text;
        if($gs->is_smtp){
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new YiwuMailer();
            $mailer->sendCustomMail($data);
        } else {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }
        // Login Section Ends

        // Redirect Section
        return response()->json($ps->contact_success);
    }

    // Refresh Capcha Code
    public function refresh_code(){
        $this->code_image();
        return "done";
    }

// -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
            return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json('You Have Subscribed Successfully.');
    }

// Maintenance Mode

    public function maintenance()
    {
        $gs = Generalsetting::find(1);
        if($gs->is_maintain != 1) {

            return redirect()->route('front.index');

        }

        return view('front.maintenance');
    }



    // Vendor Subscription Check
    public function subcheck(){
        $settings = Generalsetting::findOrFail(1);
        $today = Carbon::now()->format('Y-m-d');
        $newday = strtotime($today);
        foreach (DB::table('users')->where('is_vendor','=',2)->get() as  $user) {
            $lastday = $user->date;
            $secs = strtotime($lastday)-$newday;
            $days = $secs / 86400;
            if($days <= 5)
            {
                if($user->mail_sent == 1)
                {
                    if($settings->is_smtp == 1)
                    {
                        $data = [
                            'to' => $user->email,
                            'type' => "subscription_warning",
                            'cname' => $user->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'onumber' => ""
                        ];
                        $mailer = new YiwuMailer();
                        $mailer->sendAutoMail($data);
                    }
                    else
                    {
                        $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                        mail($user->email,'Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.',$headers);
                    }
                    DB::table('users')->where('id',$user->id)->update(['mail_sent' => 0]);
                }
            }
            if($today > $lastday)
            {
                DB::table('users')->where('id',$user->id)->update(['is_vendor' => 1]);
            }
        }
    }
    // Vendor Subscription Check Ends

    public function trackload($id)
    {
        $order = Order::where('order_number','=',$id)->first();
        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load',compact('order','datas'));

    }



    // Capcha Code Image
    private function  code_image()
    {
        return generateCaptcha();
    }

// -------------------------------- CONTACT SECTION ENDS----------------------------------------



// -------------------------------- PRINT SECTION ----------------------------------------


    /*function finalize(){
        $actual_path = public_path().'/';

        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }*/

    /*function auth_guests(){
        $actual_path = public_path().'/';

                if (is_dir($actual_path . '/install')) {
                    header("Location: " . url('/install'));
                    die();
                }
    }

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }*/

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    public function requestQuote(Request $request ){
        return view('front.request-quote');
    }
    public function requestQuotePost(Request $request){
        $data=[];
        $rules = [
            'name'	=> 'required',
            'email'   => 'required|email',
            'type'	=> 'required',
            'quote_categories'	=> 'required',
            'make_deal_safe'	=> 'required',
            'agree_with_term_condition'	=> 'required',
        ];
        $messages = [
            'type.required' => 'Please tell us who are you?',
            'quote_categories.required' => 'Please Select at least one Category',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return json_encode([
                'success' => 'false',
                'message' => $validator->messages(),
            ]);
        }
        $data['name']=$request->name;
        $data['details']=$request->details;
        $data['email']=$request->email;
        $data['type']=$request->type;
        $data['phone']=$request->phone;
        $data['city']=$request->city;

        $ip_address = getRealIpAddr();
        $ip_info = ip_info($ip_address,'countrycode');
        $data['ip'] = $ip_address;
        $data['country_code'] = $ip_info;

        $categories = $request->quote_categories;
        $quoteID = Quote::insertGetId($data);
        foreach ($categories as $category){
            $category = explode('##',$category);
            if($category[0] == 'main_cat'){
                $category_type = 'Main Category';
            }
            if($category[0] == 'sub_cat'){
                $category_type = 'Sub Category';
            }
            if($category[0] == 'child_cat'){
                $category_type = 'Child Category';
            }
            QuoteCategory::insert(['type'=>$category_type,'cat_id'=>$category[1],'quote_id'=>$quoteID]);
        }
        $data = [];
        $files = [];
        $files_array = $request->file('files');
        if ($request->hasFile('files')) {
            foreach($files_array as $key=>$file){
                $file_name = time().'-'.rand(1,999).'-'.$key.'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/files/quotes/'.$quoteID.'/';
                if(!is_dir($destinationPath)){
                    mkdir($destinationPath,0777);
                }
                $file->move($destinationPath,$file_name);
                $files[] = $file_name;
            }
            $data['files']  = json_encode($files);
            Quote::where('id','=',$quoteID)->update($data);
        }

        Notification::insert(['quote_id'=>$quoteID]);

        return json_encode([
            'success' => 'success',
            'message' => 'Thanks! Your quote request have been received and we will notify you soon once approved.',
        ]);
    }

    public function featuredSuppliers(Request $requets){

        $category_selections = Category::select('id','name','slug','photo')->where('status','=','1')->where('featured_for_suppliers','=','1')->orderBy('suppliers_sort_order','ASC')->take(10)->get()->map(function ($query) {
            $query->setRelation('vendors_by_parent_cat', $query->vendors_by_parent_cat->take(10));
            return $query;
        })->toArray();
        $page_data = Service::where('home_page_link','=','featured-suppliers')->first();
        $counties_code = Countries::pluck('country_code','country_name')->toArray();
        return view('front.featured-suppliers',compact('category_selections','page_data','counties_code'));
    }
    public function featuredProducts(Request $requets){

        $category_selections = Category::where('status','=','1')->whereIn('type',['product','both'])->where('featured_for_products','=','1')->orderBy('products_sort_order','ASC')->take(10)->get()->map(function ($query) {
            $query->setRelation('products', $query->products->where('type','=','Physical')->take(10));
            return $query;
        });
        $page_data = Service::where('home_page_link','=','featured-products')->first();
        return view('front.featured-products',compact('category_selections','page_data'));
    }
    public function featuredServices(Request $requets){

        $category_selections = Category::where('status','=','1')->whereIn('type',['services','both'])->where('featured_for_services','=','1')->orderBy('products_sort_order','ASC')->take(10)->get()->map(function ($query) {
            $query->setRelation('products', $query->products->where('type','=','Digital')->take(10));
            return $query;
        });
        $page_data = Service::where('home_page_link','=','featured-services')->first();
        return view('front.featured-services',compact('category_selections','page_data'));
    }
    function allQuotes(){
        $buyer_requests_query = Quote::where('status','=','Approved')->orderBy('id','desc')->with('main_categories','sub_categories','child_categories','country_info')->paginate(5);
        $buyer_requests = $buyer_requests_query->toArray();
        $buyer_requests = $buyer_requests['data'];

        $main_cat   = [];
        $sub_cat    = [];
        $child_cat  = [];
        foreach ($buyer_requests as $buyer_request){
            $main_categories = $buyer_request['main_categories'];
            foreach ($main_categories as $category){
                $main_cat[] = $category['cat_id'];
            }
            $sub_categories = $buyer_request['sub_categories'];
            foreach ($sub_categories as $category){
                $sub_cat[] = $category['cat_id'];
            }
            $child_categories = $buyer_request['child_categories'];
            foreach ($child_categories as $category){
                $child_cat[] = $category['cat_id'];
            }
        }
        $main_categories_info = Category::whereIn('id',$main_cat)->pluck('name','id')->toArray();
        $sub_categories_info = Subcategory::whereIn('id',$sub_cat)->pluck('name','id')->toArray();
        $child_categories_info = Childcategory::whereIn('id',$child_cat)->pluck('name','id')->toArray();
        return view('front.all-orders',[
            'buyer_requests_query'=>$buyer_requests_query,
            'buyer_requests'=>$buyer_requests,
            'main_categories_info'=>$main_categories_info,
            'sub_categories_info'=>$sub_categories_info,
            'child_categories_info'=>$child_categories_info,
        ]);
    }
    function editorImage(){
        $post = \request()->all();
        //debug($post,1);
        $file = \request()->file('image');
        $file_name = time().'-'.rand(1,999).'-'.'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('assets/uploads/');
        if(!is_dir($destinationPath)){
            mkdir($destinationPath,0777);
        }
        $file->move($destinationPath,$file_name);
        $data = getimagesize($destinationPath.$file_name);
        $files[] = $file_name;
        $link = url('assets/uploads/'.$file_name);
        $res = array(
            "id"=> time(),
            "width"=> $data[0],
            "height"=> $data[1],
            "name"=> "",
            "link"=> $link);
        return $response =  array('data' => $res, 'success' => true, "status" => 200);
    }
    function converPrices(){

        $price =  (732.23)/(6.46081);
        $price = $price/(6.46081);
        exit($price);
    }
}
