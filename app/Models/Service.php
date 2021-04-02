<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['user_id','title','details','photo','home_page_link','feature_page_banner','feature_banner_link'];
    public $timestamps = false;
}
