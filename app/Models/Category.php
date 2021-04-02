<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','photo','type','is_featured','image','sort_order','feature_sort_order','featured_for_products','products_sort_order','featured_for_services','services_sort_order','featured_for_suppliers','suppliers_sort_order'];
    public $timestamps = false;

    public function subs()
    {
    	return $this->hasMany('App\Models\Subcategory')->where('status','=',1);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function attributes() {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }

    public function vendors_by_parent_cat()
    {
        return $this->hasMany('App\Models\VendorCategories')->where('category_type','=','Main Category')->with(array('user'=>function($query){
            $query->select('id','name','photo','country','shop_name');
        }));
    }
    public function sub_and_child_cat()
    {
        return $this->hasMany('App\Models\Subcategory')->where('status','=',1)->with('childs');
    }
}
