<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cottage extends Model
{
    use SoftDeletes;
    protected $guarded = [];

}
