<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quote';

    public function main_categories(){
        return $this->hasMany('App\Models\QuoteCategory','quote_id','id')->where('type','=','Main Category');
    }
    public function sub_categories(){
        return $this->hasMany('App\Models\QuoteCategory','quote_id','id')->where('type','=','Sub Category');
    }
    public function child_categories(){
        return $this->hasMany('App\Models\QuoteCategory','quote_id','id')->where('type','=','Child Category');
    }
    public function country_info(){
        return $this->hasOne('App\Models\Countries','country_code','country_code');
    }
}
