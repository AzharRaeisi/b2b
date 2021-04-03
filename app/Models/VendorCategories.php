<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorCategories extends Model
{
    protected $table = 'vendor_categories';
    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');

        /*return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });*/
    }
}
