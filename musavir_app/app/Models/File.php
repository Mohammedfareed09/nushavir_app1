<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    public function file_comments()
    {
        return $this->hasMany(FileComment::class);
    }

}
