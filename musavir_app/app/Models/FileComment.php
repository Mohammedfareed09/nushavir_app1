<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileComment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

}
