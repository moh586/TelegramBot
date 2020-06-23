<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Transaction extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id','agent_id','product_id','extra', 'quantity'
    ];


    public function customer()
    {
        return $this->belongsTo('App\User','customer_id');
    }

    public function getCustomer()
    {
        return $this->customer()->first();
    }
    //
    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }

    public function getAgent()
    {
        Log::info(json_encode( $this->id));
        return $this->agent()->first();
    }
    //
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function getProduct()
    {
        return $this->product()->first();
    }
}
