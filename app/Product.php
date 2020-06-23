<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','keywords','brand','sold_by','price','price_to_pay','max_order','description','total',
                            'coupon','review_type','refund_type','commission','instructions','product_links','asin','no_of_rating','seller_id','activated'];
    //
    public function sizes()
    {
        return $this->hasMany('App\ProductSize');
    }

    public function getSizes()
    {
        return $this->sizes()->get();
    }
    //
    public function colors()
    {
        return $this->hasMany('App\ProductColor');
    }

    public function getColors()
    {
        return $this->colors()->get();
    }
    //
    public function photos()
    {
        return $this->hasMany('App\ProductPhoto');
    }

    public function getPhotos()
    {
        return $this->photos()->get();
    }
    //
    public function seller()
    {
        return $this->belongsTo('App\User');
    }

    public function getSeller()
    {
        return $this->seller()->first();
    }

}
