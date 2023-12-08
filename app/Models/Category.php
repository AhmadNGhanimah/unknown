<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{

    public function getImageAttribute($value)
    {
            return Storage::url('categories/'.$value);
    }
}
