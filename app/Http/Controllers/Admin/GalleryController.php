<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Image;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        $data[0] = 0;
        $id = $_GET['id'];
        $prod = Product::findOrFail($id);
        if(count($prod->galleries))
        {
            $data[0] = 1;
            $data[1] = $prod->galleries;
        }
        return response()->json($data);
    }

    public function store(Request $request){
        $data = null;
        $lastid = $request->product_id;

        $allow_images_type  = ['jpeg','jpg','png','svg'];
        $allow_video_type   = ['mp4','ogg'];

        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                $file_extention = $file->getClientOriginalExtension();

                if(in_array($file_extention, $allow_images_type)){ // For Images only
                    $gallery = new Gallery;

                    $img = Image::make($file->getRealPath())->resize(800, 800);
                    $thumbnail = time().str_random(8).'.'.$file_extention;
                    $img->save(public_path('/assets/images/galleries/'.$thumbnail));
                    $gallery['photo'] = $thumbnail;
                    $gallery['product_id'] = $lastid;
                    $gallery['type'] = 'image';
                    $gallery->save();
                    $data[] = $gallery;
                }
                if(in_array($file_extention, $allow_video_type)){ // For Videos only
                    $gallery = new Gallery;


                    $thumbnail = time().str_random(8).'.'.$file_extention;
                    $file->move(public_path('/assets/images/galleries/'),$thumbnail);
                    $gallery['photo'] = $thumbnail;
                    $gallery['product_id'] = $lastid;
                    $gallery['type'] = 'video';
                    $gallery->save();
                    $data[] = $gallery;
                }
            }
        }
        return response()->json($data);
    }

    public function destroy()
    {

        $id = $_GET['id'];
        $gal = Gallery::findOrFail($id);
        if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
            unlink(public_path().'/assets/images/galleries/'.$gal->photo);
        }
        $gal->delete();

    }

}
