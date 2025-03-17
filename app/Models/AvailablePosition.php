<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailablePosition extends Model
{
    protected $guarded = ['id'];

    public function vacancie()
    {
        return $this->belongsTo(JobVacancie::class , 'id');
    }
}
