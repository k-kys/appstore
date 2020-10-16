<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function apps()
    {
        return $this->belongsToMany('App\Models\App', 'app_category', 'category_id', 'app_id');
    }
}
