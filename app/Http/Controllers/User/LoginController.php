<?php

namespace App\Http\Controllers\User;

use App\Models\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function showLoginForm()
    {
        $this->code_image();
        $countries  = Countries::pluck('country_name','country_name')->toArray();
        return view('user.login',['countries'=>$countries ]);
    }

    public function login(Request $request)
    {
        //--- Validation Section
        $rules = [
            'email'   => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $is_vendor = '0';
        if($request->has('vendor')){
            $is_vendor = '1';
        }
        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'is_vendor'=>$is_vendor])) {
            // if successful, then redirect to their intended location

            // Check If Email is verified or not
            if(Auth::guard('web')->user()->email_verified == 'No') {
                Auth::guard('web')->logout();
                return response()->json(array('errors' => [ 0 => 'Please click on the that has sent to your email account to verify your email and continue the login process. ']));
            }

            if(Auth::guard('web')->user()->ban == 1) {

                Auth::guard('web')->logout();
                return response()->json(array('errors' => [ 0 => 'Sorry! you are not able to login please contact the technical support.' ]));
            }
            /*if(Auth::guard('web')->user()->status == 0) {
                Auth::guard('web')->logout();
                return response()->json(array('errors' => [ 0 => 'Sorry! Your account is currently pending approval by the site administrator' ]));
            }*/
            // Login Via Modal
            if(!empty($request->modal))
            {
                // Login as Vendor
                if(!empty($request->vendor)) {

                    /*if(Auth::guard('web')->user()->is_vendor == 2) {
                        return response()->json(route('vendor-dashboard'));
                    } else {
                        return response()->json(route('user-package'));
                    }*/
                    return response()->json(route('vendor-dashboard'));
                }
                // Login as User
                return response()->json(1);
            }
            // Login as User
            return response()->json(route('user-dashboard'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    // Capcha Code Image
    private function  code_image()
    {
        return generateCaptcha();
    }

}
