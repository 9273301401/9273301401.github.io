<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tel extends Model
{
    use SoftDeletes;

    protected $fillable = ['tel','up_time','status'];
}
