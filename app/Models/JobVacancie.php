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
        return $this->hasOne(AvailablePosition::class , 'job_vacancy_id');
    }

    public function jobApplyPosition()
    {
        return $this->hasOne(JobApplyPosition::class , 'job_vacancy_id');
    }

    public function jobApplySocietie()
    {
        return $this->hasOne(JobApplySocietie::class , 'job_vacancy_id');
    }
}
