<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailablePosition extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $hidden = [
        'job_vacancy_id',
    ];

    public function vacancie()
    {
        return $this->belongsTo(JobVacancie::class , 'id');
    }
}
