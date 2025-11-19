<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $primaryKey = 'group_member_id';

    protected $fillable = [
        'group_id',
        'customer_id',
        'joined_at',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
