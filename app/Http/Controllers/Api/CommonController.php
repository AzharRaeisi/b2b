<?php

namespace App\Http\Controllers\Api;

use App\Classes\YiwuMailer;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Slider;
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


class CommonController extends Controller
{
    function getContent(){
        $response = [];

        $product_categories         = Category::select('id','name','slug','status','photo','is_featured','feature_sort_order')->where('status','=',1)->whereIn('type',['product','both'])->orderBy('sort_order','ASC')->with('sub_and_child_cat')->get()->toArray();// Product Categories
        foreach ($product_categories as $key=>$category){
            $category['photo'] = asset('assets/images/categories/'.$category['photo']);
            $product_categories[$key] = $category;
        }
        $service_categories  = Category::select('id','name','slug','status','photo','is_featured','feature_sort_order')->where('status','=',1)->whereIn('type',['services','both'])->orderBy('sort_order','ASC')->with('sub_and_child_cat')->get()->toArray();// Service Categories
        foreach ($service_categories  as $key=>$category){
            $category['photo'] = asset('assets/images/categories/'.$category['photo']);
            $service_categories[$key] = $category;
        }
        $response['product_categories'] = $product_categories;
        $response['service_categories'] = $service_categories;

        $response['product_type'] = [['id'=>'Physical','title'=>'Physical','description'=>'This is Product Type.'],['id'=>'Digital','title'=>'Digital','description'=>'This is service Type.']];
        return buildResponse('success',"Data get Successfully.", $response);
    }
    function getHomeData(){
        $response = [];

        $sliders    = Slider::select('id','photo')->where('use_for','=','Application')->get()->toArray();
        foreach ($sliders as $key=>$slider){
            $slider['photo'] = asset('assets/images/sliders/'.$slider['photo']);
            $sliders[$key] = $slider;
        }
        $services   = Service::select('id','title','details','photo','feature_page_banner')->orderBy('id','DESC')->where('user_id','=',0)->get()->toArray();
        foreach ($services as $key=>$service){
            $service['photo'] = asset('assets/images/services/'.$service['photo']);
            $service['feature_page_banner'] = asset('assets/images/services/'.$service['feature_page_banner']);
            $services[$key] = $service;
        }

        $response['sliders'] = $sliders;
        $response['services'] = $services;

        debug($services,1);

    }
}