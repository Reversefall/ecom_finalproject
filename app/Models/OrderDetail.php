<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'group_id',
        'quantity',
        'unit_price',
        'discount',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
