<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Lead extends Model
{
    protected $table = "leads";
    protected $fillable = [
        'name', 'email', 'contact', 'dob','address','state','city','pincode','company','department','designation','others', 'added_by','status', 'created_at'
    ];
}


