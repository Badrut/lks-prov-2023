<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplySocietie extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function vacancie()
    {
        return $this->belongsTo(JobVacancie::class , 'id');
    }

    public function societie()
    {
        return $this->belongsTo(Societie::class , 'society_id');
    }
}
