<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Audio extends Model
{

    protected $table = 'audios';

    public function getPathAttribute($value)
    {
        return url(Storage::url('audios/' . $value));
    }
}
