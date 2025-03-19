<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancie extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function avaliable()
    {
        return $this->hasMany(AvailablePosition::class , 'job_vacancy_id');
    }

    public function jobApplyPosition()
    {
        return $this->hasMany(JobApplyPosition::class , 'job_vacancy_id');
    }

    public function jobApplySocietie()
    {
        return $this->hasMany(JobApplySocietie::class , 'job_vacancy_id');
    }
}
