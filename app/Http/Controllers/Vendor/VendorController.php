<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Generalsetting;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\VendorCategories;
use App\Models\VendorOrder;
use App\Models\Verification;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;

class VendorController extends Controller
{

    public $lang;
    public function __construct()
    {

        /*if (Session::has('language'))
        {
            $data = DB::table('languages')->find(Session::get('language'));
            $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
            $this->lang = json_decode($data_results);
        }
        else
        {
            $data = DB::table('languages')->where('is_default','=',1)->first();
            $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
            $this->lang = json_decode($data_results);

        }*/
    }

    //*** GET Request
    public function index()
    {
        $user = Auth::user();
        $pending = VendorOrder::where('user_id','=',$user->id)->where('status','=','pending')->count();
        $processing = VendorOrder::where('user_id','=',$user->id)->where('status','=','processing')->count();
        $completed = VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->count();
        return view('vendor.index',compact('user','pending','processing','completed'));
    }

    public function profileupdate(Request $request)
    {
        //debug($request->all(),1);
        //--- Validation Section
        $rules = [];
        //$rules['shop_image'] = 'mimes:jpeg,jpg,png,svg';
        $rules['photo'] = 'mimes:jpeg,jpg,png,svg';

        $input = $request->all();
        if($input['who_are_you'] == 'product'){

            //$rules['shop_image'] = 'required';
            $customs = [
                'product_categories.required' => 'Please select at leat one Product Category.'
            ];
        }elseif($input['who_are_you'] == 'services'){
            $rules['services_categories'] = 'required';
            $customs = [
                'services_categories.required'  => 'Please select at least one Services Category.'
            ];
        }elseif($input['who_are_you'] == 'both'){

            $rules['product_categories'] = 'required';
            $rules['services_categories'] = 'required';
            $customs = [
                'product_categories.required' => 'Please select at leat one Product Category.',
                'services_categories.required'  => 'Please select at least one Services Category.'
            ];
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $input = $request->all();
        //debug($input,1);
        $data = Auth::user();
        $file = $request->file('shop_image');
        if ($file && !empty($file)) {
            $name = time().$file->getClientOriginalName();
            $file->move(public_path('assets/images/vendorbanner'),$name);
            $input['shop_image'] = $name;
        }
        $file = $request->file('photo');
        if ($file && !empty($file)) {
            $name = time().$file->getClientOriginalName();
            $file->move(public_path('assets/images/users/'),$name);
            if($data->photo != null){
                if (file_exists(public_path('/assets/images/users/'.$data->photo))) {
                    unlink(public_path('/assets/images/users/'.$data->photo));
                }
            }
            $input['photo'] = $name;
        }
        //debug($input,1);
        $data->update($input);

        $product_categories  = [];
        $services_categories = [];
        if($input['who_are_you'] == 'product'){
            $product_categories = $input['product_categories'];
        }elseif($input['who_are_you'] == 'services'){
            $services_categories = $input['services_categories'];
        } else {
            $product_categories = $input['product_categories'];
            $services_categories = $input['services_categories'];
        }
        if(isset($input['product_categories'])){
            VendorCategories::where('user_id','=',Auth::user()->id)->delete();
        }
        foreach ($product_categories  as $product_category){
            $category_type_arr = explode('##',$product_category);
            $category_type = $category_type_arr[0];
            $category_id = $category_type_arr[1];
            if($category_type == 'main_cat'){
                $category_type = 'Main Category';
            }else if($category_type == 'sub_cat'){
                $category_type = 'Sub Category';
            }else{
                $category_type = 'Child Category';
            }
            $data_cat = [];
            $data_cat['user_id'] = Auth::user()->id;
            $data_cat['category_id'] = $category_id;
            $data_cat['category_type'] = $category_type;
            $data_cat['who_are'] = 'Product';

            VendorCategories::insert($data_cat);
        }
        foreach ($services_categories  as $services_category){
            $category_type_arr = explode('##',$services_category);
            $category_type = $category_type_arr[0];
            $category_id = $category_type_arr[1];
            if($category_type == 'main_cat'){
                $category_type = 'Main Category';
            }else if($category_type == 'sub_cat'){
                $category_type = 'Sub Category';
            }else{
                $category_type = 'Child Category';
            }
            $data_cat = [];
            $data_cat['user_id'] = Auth::user()->id;
            $data_cat['category_id'] = $category_id;
            $data_cat['category_type'] = $category_type;
            $data_cat['who_are'] = 'Services';
            VendorCategories::insert($data_cat);
        }
        $msg = 'Successfully updated your profile';
        return response()->json($msg);
    }

    // Spcial Settings All post requests will be done in this method
    public function socialupdate(Request $request)
    {
        //--- Logic Section
        $input = $request->all();
        $data = Auth::user();
        if ($request->f_check == ""){
            $input['f_check'] = 0;
        }
        if ($request->t_check == ""){
            $input['t_check'] = 0;
        }

        if ($request->g_check == ""){
            $input['g_check'] = 0;
        }

        if ($request->l_check == ""){
            $input['l_check'] = 0;
        }
        $data->update($input);
        //--- Logic Section Ends
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends                

    }

    //*** GET Request
    public function profile()
    {
        $data = Auth::user();
        return view('vendor.profile',compact('data'));
    }

    //*** GET Request
    public function ship()
    {
        $gs = Generalsetting::find(1);
        if($gs->vendor_ship_info == 0) {
            return redirect()->back();
        }
        $data = Auth::user();
        return view('vendor.ship',compact('data'));
    }

    //*** GET Request
    public function banner()
    {
        $data = Auth::user();
        return view('vendor.banner',compact('data'));
    }

    //*** GET Request
    public function social()
    {
        $data = Auth::user();
        return view('vendor.social',compact('data'));
    }

    //*** GET Request
    public function subcatload($id)
    {
        $cat = Category::findOrFail($id);
        return view('load.subcategory',compact('cat'));
    }

    //*** GET Request
    public function childcatload($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }

    //*** GET Request
    public function verify()
    {
        $data = Auth::user();
        if($data->checkStatus())
        {
            return redirect()->back();
        }
        return view('vendor.verify',compact('data'));
    }

    //*** GET Request
    public function warningVerify($id)
    {
        $verify = Verification::findOrFail($id);
        $data = Auth::user();
        return view('vendor.verify',compact('data','verify'));
    }

    //*** POST Request
    public function verifysubmit(Request $request)
    {
        //--- Validation Section
        $rules = [
            'attachments.*'  => 'mimes:jpeg,jpg,png,svg|max:10000'
        ];
        $customs = [
            'attachments.*.mimes' => 'Only jpeg, jpg, png and svg images are allowed',
            'attachments.*.max' => 'Sorry! Maximum allowed size for an image is 10MB',
        ];

        $validator = Validator::make(Input::all(), $rules,$customs);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = Verification::where('user_id','=',Auth::user()->id)->first();
        $input = $request->all();
        $text = json_decode($data->text,1);
        $text[] = 'Verification received '.$input['text'];
        $input['text'] = json_encode($text);
        $input['attachments'] = '';
        $i = 0;
        if ($files = $request->file('attachments')){
            foreach ($files as  $key => $file){
                $name = time().$file->getClientOriginalName();
                if($i == count($files) - 1){
                    $input['attachments'] .= $name;
                }
                else {
                    $input['attachments'] .= $name.',';
                }
                $file->move('assets/images/attachments',$name);

                $i++;
            }
        }
        $attachments = $data->attachments;
        $input['attachments'] = $attachments.', '.$input['attachments'];
        $input['status'] = 'Pending';
        $input['user_id'] = Auth::user()->id;
        $verify = Verification::findOrFail($request->verify_id);
        $input['admin_warning'] = 0;
        $verify->update($input);
        //--- Redirect Section        
        $msg = '<div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>'.$this->lang->lang804.'</h3></div>';
        return response()->json($msg);
        //--- Redirect Section Ends     
    }

    function passwordUpdate(Request $request){
        $rules = [];
        $rules['current_password'] = [
            'required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Old Password didn\'t match');
                }
            },
        ];
        $rules['password'] = 'required|confirmed';
        $rules['password_confirmation'] = 'required';


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $new_password = bcrypt($request->password);
        User::whereId(Auth::user()->id)->update(['password'=>$new_password]);
        $request->session()->flash('success', 'Your password has been updated successfully.');
        return redirect()->back();
    }
}
