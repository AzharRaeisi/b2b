<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = Language::orderBy('id')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('action', function(Language $data) {
                $delete = $data->id == 1 ? '':'<a href="javascript:;" data-href="' . route('admin-lang-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                $default = $data->is_default == 1 ? '<a><i class="fa fa-check"></i> Default</a>' : '<a class="status" data-href="' . route('admin-lang-st',['id1'=>$data->id,'id2'=>1]) . '">Set Default</a>';
                return '<div class="action-list"><a href="' . route('admin-lang-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a>'.$delete.$default.'</div>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.language.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.language.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all();
        $data = new Language();
        $data->language = $input['language'];
        $data->file = time().str_random(8).'.json';
        $data->save();
        unset($input['_token']);
        unset($input['language']);
        $mydata = json_encode($input);
        file_put_contents(public_path().'/assets/languages/'.$data->file, $mydata);
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {

        $data = Language::findOrFail($id);
        $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
        $lang = json_decode($data_results);

        /*$tr = new GoogleTranslate();
        $data = [];
        foreach ($lang as $lang_key=>$lang_word){
            if($lang_key != 'rtl'){
                $data[$lang_key] = $tr->setSource('en')->setTarget('zh')->translate($lang_word);
            }else{
                $data['rtl'] = $lang_word;
            }
        }
        echo json_encode($data);exit;*/
        $new_words = [
            'Categories',
            'Product Search',
            'Service Search',
            'Suppliers Search',
            'Supplier',
            'Products',
            'Services',
            'Track Order',
            'Search something...',
            'Get Quotes',
            'Get',
            'Quotes',
            'World Fashion',
            'Highlight your personality and look',
            'with these fabulous and exquisite fashion',
            'Find the best suppliers from all over the world',
            'More than 800 product categories at competitive prices',
            'Find your required business services from more than 800 categories',
            'For Suppliers',
            'Add Company',
            'Sell your products',
            'Orders',
            'Checkout the buyer',
            'requests',
            'Promotions',
            'Promote your products',
            'on YWBazar',
            'Blog',
            'Checkout the',
            'Latest news',
            'For Buyers',
            'Products',
            'Check the list of 5m+',
            'products worldwide',
            'Suppliers',
            'Find the bes supplier',
            'from the world',
            'Services',
            'Find your required',
            'business service',
            'Get Quotes',
            'Create a request and get',
            'offers from suppliers',
            'Small Commodities Marketplace',
            'Join Us',
            'Category Selections',
            'View all',
            'Buyer Request',
            'View more',
            'Get',
            'quotes',
            'Find suppliers by',
            'creating one request',
            'Featured Brands',
            'Latest from',
            'Blog',
            'Worlwide Delivery',
            'More Than 200 Countries',
            'Great Value',
            'More Than 200 Countries',
            'Secure Payment',
            'More Than 200 Countries',
            'Support 247',
            'More Than 200 Countries',
            'Request A Quote',
            'Make a detailed description of the characteristics of the products you are looking for',
            'Details',
            'Full Name',
            'city',
            'Phone Number',
            'What are you looking for?',
            'Product supplier',
            'Services supplier',
            'Select a category so we can more accurately match with right suppliers',
            'Attach images/documents, this will help suppliers to better understand your requirements',
            'Drag&Drop files here',
            'Submit',
            'Buy',
            'Create',
            'View all',
            'Detailed description'
        ];
        return view('admin.language.edit',compact('data','lang','new_words'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all();
        $data = Language::findOrFail($id);
        if (file_exists(public_path().'/assets/languages/'.$data->file)) {
            unlink(public_path().'/assets/languages/'.$data->file);
        }
        $data->language = $input['language'];
        $data->file = time().str_random(8).'.json';
        $data->update();
        unset($input['_token']);
        unset($input['language']);
        $mydata = json_encode($input);
        file_put_contents(public_path().'/assets/languages/'.$data->file, $mydata);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends            
    }

    public function status($id1,$id2)
    {
        $data = Language::findOrFail($id1);
        $data->is_default = $id2;
        $data->update();
        $data = Language::where('id','!=',$id1)->update(['is_default' => 0]);
        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        if($id == 1)
        {
            return "You don't have access to remove this language";
        }
        $data = Language::findOrFail($id);
        if($data->is_default == 1)
        {
            return "You can not remove default language.";
        }


        if (file_exists(public_path().'/assets/languages/'.$data->file)) {
            unlink(public_path().'/assets/languages/'.$data->file);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends     
    }
}
