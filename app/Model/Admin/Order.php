<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping',
        'total',
        'status',
        'month',
        'date',
        'year',
    ];
}
