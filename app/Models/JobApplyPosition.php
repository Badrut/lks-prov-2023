<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplyPosition extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function vacancie()
    {
        return $this->belongsTo(JobVacancie::class , 'id');
    }
}
