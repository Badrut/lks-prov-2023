<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Societie extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function applyjob()
    {
        return $this->hasOne(JobApplySocietie::class);
    }
}
