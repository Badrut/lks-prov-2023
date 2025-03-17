<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancie extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'id');
    }

}
