<?php

namespace App\Http\Controllers\Admin;

use App\Models\Socialsetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class SocialSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Spcial Settings All post requests will be done in this method
    public function socialupdate(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all(); 
        $data = Socialsetting::findOrFail(1);   
        $data->update($input);
        //--- Logic Section Ends
        
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends               

    }


    // Spcial Settings All post requests will be done in this method
    public function socialupdateall(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all(); 
        $data = Socialsetting::findOrFail(1);
        $data->update($input);
        //--- Logic Section Ends
        
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends               

    }


    public function index()
    {
    	$data = Socialsetting::findOrFail(1);
        return view('admin.socialsetting.index',compact('data'));
    }

    public function facebook()
    {
    	$data = Socialsetting::findOrFail(1);
        return view('admin.socialsetting.facebook',compact('data'));
    }

    public function google()
    {
    	$data = Socialsetting::findOrFail(1);
        return view('admin.socialsetting.google',compact('data'));
    }


    public function facebookup($status)
    {
        $data = Socialsetting::findOrFail(1);
        $data->f_check = $status;
        $data->update();
    }

    public function googleup($status)
    {
        
        $data = Socialsetting::findOrFail(1);
        $data->g_check = $status;
        $data->update();
    }

}
