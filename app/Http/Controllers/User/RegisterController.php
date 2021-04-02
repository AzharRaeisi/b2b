<?php

namespace App\Http\Controllers\User;

use App\Models\VendorCategories;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\YiwuMailer;
use App\Models\Notification;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

        $gs = Generalsetting::findOrFail(1);
        if($gs->is_capcha == 1) {

            $value = session('captcha_string');
            if ($request->codes != $value){
                return ['success'=>'false','message'=>['Please enter Correct Capcha Code.']];
            }
        }
        //--- Validation Section
        $rules = [
            'name' => 'required',
            'email'   => 'required|email|unique:users',
            'password' => 'required|confirmed',
            //'country' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return ['success'=>'false','message'=>$validator->getMessageBag()->toArray()];
        }
        //--- Validation Section Ends

        $user = new User;
        $input = $request->all();
        $input['password'] = bcrypt($request['password']);
        $token = md5(time().$request->name.$request->email);
        $input['verification_link'] = $token;
        $input['affilate_code'] = md5($request->name.$request->email);

        if(!empty($request->vendor)) {
            //--- Validation Section
            $rules = [
                //'shop_name' => 'unique:users',
                'shop_number'  => 'max:10',
                'who_are_you' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'who_are_you' => 'required',
                'reg_number' => 'required',
                'shop_message' => 'required',
            ];
            if($input['who_are_you'] == 'product'){
                $rules = [
                    'product_categories' =>'required'
                ];
                $customs = [
                    'product_categories.required' => 'Please select at least one Product Category.'
                ];
            }elseif($input['who_are_you'] == 'services'){
                $rules = [
                    'services_categories' =>'required'
                ];
                $customs = [
                    'services_categories.required'  => 'Please select at least one Services Category.'
                ];
            }elseif($input['who_are_you'] == 'both'){
                $rules = [
                    'product_categories' =>'required',
                    'services_categories' =>'required'
                ];
                $customs = [
                    'product_categories.required' => 'Please select at leat one Product Category.',
                    'services_categories.required'  => 'Please select at least one Services Category.'
                ];
            }
            /*$customs = [
                'shop_name.unique' => 'This Shop Name has already been taken.',
                'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
            ];*/

            $validator = Validator::make(Input::all(), $rules, $customs);
            if ($validator->fails()) {
                return ['success'=>'false','message'=>$validator->getMessageBag()->toArray()];
            }
            $input['is_vendor'] = '1';
            $input['shop_name'] = slugify($request['name']);
        }
        $user->fill($input)->save();

        /*Notification*/
        if(!empty($request->vendor)) {

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
                $data_cat['user_id'] = $user->id;
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
                $data_cat['user_id'] = $user->id;
                $data_cat['category_id'] = $category_id;
                $data_cat['category_type'] = $category_type;
                $data_cat['who_are'] = 'Services';
                VendorCategories::insert($data_cat);
            }

            $user->shop_name = $user->shop_name.'-'.$user->id;
            $user->save();
            $message = 'Vendor register successfully';
            $redirect_to = route('vendor-dashboard');
            /*Notification*/
            $notification = new Notification;
            $notification->vendor_id = $user->id;
            $notification->save();
            Auth::guard('web')->login($user);

        }else{
            $message = 'User register successfully';
            $redirect_to = route('user-dashboard');

            /*Notification*/
            $notification = new Notification;
            $notification->user_id = $user->id;
            $notification->save();
            Auth::guard('web')->login($user);
        }

        /*Upload verification documents start*/
        $files = [];
        $files_array = $request->file('files');
        if ($request->hasFile('files')) {
            foreach($files_array as $key=>$file){
                $file_name = time().'-'.rand(1,999).'-'.str_replace(',','',$file->getClientOriginalName());
                $destinationPath = public_path('assets/images/attachments');
                if(!is_dir($destinationPath)){
                    mkdir($destinationPath,0777);
                }
                $file->move($destinationPath,$file_name);
                $files[] = $file_name;
            }
            $files  = implode(',', $files);
        }

        $verification_data = [];
        if(!empty($request->vendor)) {
            $verification_data['type'] = 'Vendor';
        }else{
            $verification_data['type'] = 'Buyer';
        }
        $verification_data['user_id'] = $user->id;
        $verification_data['attachments'] = $files;
        $verification_data['status'] = 'Pending';
        $verification_data['text'] = json_encode(['New '.$verification_data['type'].' Registered']);
        Verification::insert($verification_data);

        /*Upload verification documents end*/


        if($gs->is_verification_email == 1) {

            $to = $request->email;
            $subject = 'Verify your email address.';
            $msg = "Dear Customer, <br /> We noticed that you need to verify your email address. <a href='".url('user/register/verify/'.$token)."'>Simply click</a> here to verify.";

            //Sending Email To Customer
            if($gs->is_smtp == 1) {
                $data = [
                    'to' => $to,
                    'subject' => $subject,
                    'body' => $msg,
                ];

                $mailer = new YiwuMailer();
                $mailer->sendCustomMail($data);
            }else{

                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$msg,$headers);
            }
            return ['success'=>'true','message'=>['We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.']];
        } else {
            $user->email_verified = 'Yes';
            $user->update();
        }
        return ['success'=>'true','message'=>$message,'send_to'=>$redirect_to];
    }

    public function token($token){

        $gs = Generalsetting::findOrFail(1);

        if($gs->is_verification_email == 1)
        {
            $user = User::where('verification_link','=',$token)->first();
            if(isset($user))
            {
                $user->email_verified = 'Yes';
                $user->update();
                $notification = new Notification;
                $notification->user_id = $user->id;
                $notification->save();
                Auth::guard('web')->login($user);
                return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
            }
        }
        else {
            return redirect()->back();
        }
    }
}