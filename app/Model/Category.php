<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $guarded = [];

    public function resorts()
    {
        return $this->belongsToMany(Resort::class)->withTimestamps();
    }

    public function tourists()
    {
        return $this->belongsToMany(Tourist::class)->withTimestamps();
    }
}
