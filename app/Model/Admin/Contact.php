<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
    ];
}
