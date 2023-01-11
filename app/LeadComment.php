<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class LeadComment extends Model
{
    protected $table = "lead_comments";
    protected $fillable = [
        'lead_id', 'comment', 'added_by','created_at'
    ];
}
