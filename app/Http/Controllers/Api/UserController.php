<?php

namespace App\Http\Controllers\Api;

use App\Classes\YiwuMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\User;
use App\Models\VendorCategories;
use App\Models\Verification;
use App\Models\OauthAccessToken;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;


class UserController extends Controller
{
    function register(Request $request){
        $gs = Generalsetting::findOrFail(1);
        $rules = [
            'name' => 'required',
            'email'   => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'country' => 'required',
            'device_type' => 'required',
            'token' => 'required'
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
            $redirect_to = 'vendor-dashboard';
            /*Notification*/
            $notification = new Notification;
            $notification->vendor_id = $user->id;
            $notification->save();
        }else{
            $message = 'User register successfully';
            $redirect_to = 'user-dashboard';

            /*Notification*/
            $notification = new Notification;
            $notification->user_id = $user->id;
            $notification->save();
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

        $verification_email_sent = '0';
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
            $verification_email_sent = '1';
        } else {
            $user->email_verified = 'Yes';
            $user->update();
        }
        $data_response = [];
        $token =  $user->createToken(request('device_type'))->accessToken;
        OauthAccessToken::where('user_id','=',$user->id)->update(['device_id'=>$request->token]);
        $data_response['user_info'] = getLoginUserInfo($user->id);
        $data_response['token'] = $token;
        $data_response['verification_email_sent'] = $verification_email_sent;
        return ['success'=>'true','message'=>$message,'send_to'=>$redirect_to,'data'=>$data_response];
    }
    function login(Request $request)
    {
        //debug($request->all(),1);
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'user_type' => 'required',
            'device_type'=> 'required',
            'token'=> 'required'
        ]);
        if ($validator->fails()) {
            return buildResponse('error',"Fields Validation Errors.",['errors'=>buildValidationErrors($validator->errors())]);
        }

        OauthAccessToken::where('device_id','=',request('token'))->where('name','=',request('device_type'))->delete();
        $email = $request->email;
        $auth_array['email'] = $email;
        $auth_array['password'] = $request->password;
        if($request->user_type == 'buyer'){
            $auth_array['is_vendor'] = '0';
        }
        if($request->user_type == 'supplier'){
            $auth_array['is_vendor'] = '1';
        }
        //debug($auth_array,1);
        if(Auth::attempt($auth_array)){
            $user = Auth::user();

            $tokenRow =  $user->createToken(request('device_type'));
            $tokenRowId = $tokenRow->token->id;
            $token = $tokenRow->accessToken;
            OauthAccessToken::whereId($tokenRowId)->update(['device_id'=>request('token')]);
            $data['user_info'] = getLoginUserInfo($user->id);
            $data['token'] = $token;

            return buildResponse('success',"User Login Successfully.",$data);
        }
        else{
            return buildResponse('error',"Invalid Username or Password.");
        }
    }
    function logout(){
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }
        return buildResponse('success',"User Logout Successfully.");
    }
}