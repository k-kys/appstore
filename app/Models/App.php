<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    public function operating_systems()
    {
        return $this->belongsTo('App\Models\OperatingSystem', 'operating_system_id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'app_category', 'app_id', 'category_id');
    }
}
