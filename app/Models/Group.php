<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = 'group_id';

    protected $fillable = [
        'creator_id',
        'product_id',
        'group_name',
        'description',
        'max_quantity',
        'status',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'group_id');
    }
}
