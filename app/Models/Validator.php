<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validator extends Model
{
    protected $guarded = ['id'];

    public function validation()
    {
        return $this->hasMany(Validation::class);
    }
}
