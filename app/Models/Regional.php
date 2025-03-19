<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $guarded = ['id'];

    public function societie()
    {
        return $this->hasMany(Regional::class);
    }
}
