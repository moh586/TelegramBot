<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    protected $fillable = ['product_id','color'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }



}
