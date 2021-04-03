<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Quote;
use App\Models\Subcategory;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestsAQuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        $post = \request()->all();

        $datas = Quote::select('*');
        if(isset($post['status']) && !empty($post['status'])){
            $datas = $datas->where('status','=',$post['status']);
        }
        $datas = $datas->orderBy('id','desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('sl', function(Quote $data) {
                $id = 1;
                return $id++;
            })->addColumn('status', function(Quote $data) {
                if($data->status == 'Pending'){
                    return '<span class="badge badge-info">'.$data->status.'</span>';
                }
                if($data->status == 'Approved'){
                    return '<span class="badge badge-success">'.$data->status.'</span>';
                }
                if($data->status == 'Reject'){
                    return '<span class="badge badge-danger">Rejected</span>';
                }

            })->addColumn('action', function(Quote $data) {
                return '<a class="badge badge-success" href="'.route('admin-brequests-detail',$data['id']).'"><i class="fa fa-eye"></i> View</a><a href="javascript:;" data-href="' . route('admin-brequests-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete badge badge-danger"><i class="fas fa-trash-alt"></i> Delete</a>';
            })
            ->toJson();//--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        $post = \request()->all();
        $status = 'Pending';
        if(isset($post['status']) && !empty($post['status'])){
            $status = $post['status'];
        }
        return view('admin.quotes.index',['status'=>$status]);
    }
    public function indexReject()
    {
        $post = \request()->all();
        $status = 'reject';
        return view('admin.quotes.index',['status'=>$status]);
    }
    public function indexApproved()
    {
        $post = \request()->all();
        $status = 'approved';
        return view('admin.quotes.index',['status'=>$status]);
    }
    function detail($id){

        $row = Quote::whereId($id)->first();
        if(empty($row)){
            abort(404);
        }

        $main_cat   = [];
        $sub_cat    = [];
        $child_cat  = [];

        $main_categories = $row->main_categories->toArray();
        foreach ($main_categories as $category){
            $main_cat[] = $category['cat_id'];
        }
        $sub_categories = $row->sub_categories->toArray();
        foreach ($sub_categories as $category){
            $sub_cat[] = $category['cat_id'];
        }
        $child_categories = $row->child_categories->toArray();
        foreach ($child_categories as $category){
            $child_cat[] = $category['cat_id'];
        }
        $main_categories_info = Category::whereIn('id',$main_cat)->pluck('name','id')->toArray();
        $sub_categories_info = Subcategory::whereIn('id',$sub_cat)->pluck('name','id')->toArray();
        $child_categories_info = Childcategory::whereIn('id',$child_cat)->pluck('name','id')->toArray();

        $data = [];
        $data['data'] = $row;
        $data['main_categories_info']   = $main_categories_info;
        $data['sub_categories_info']    = $sub_categories_info;
        $data['child_categories_info']  = $child_categories_info;
        return view('admin.quotes.detail', $data);
    }
    function statusUpdate($quote_id,$status){
        Quote::whereId($quote_id)->update(['status'=>$status]);
        return 'true';
    }
    function buyerRequestDelete($id){
        Quote::whereId($id)->delete();
        return 'true';
    }
}
