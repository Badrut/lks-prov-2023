<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobVacancie;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    public function index()
    {
       try {
        $vacancie = JobVacancie::with('category' , 'avaliable')->get();

        foreach ($vacancie as $v)
        {
            $data = [
                'position' => $v->avaliable->position,
                'capacity' => $v->avaliable->capacity,
                'apply_capacity' => $v->avaliable->apply_capacity
            ];
            return response()->json(['vacancie' =>
        [
            'id' => $v->id,
            'category' => $v->category,
            'Company' => $v->company,
            'address' => $v->address,
            'description' =>$v->description,
            'avaliable_positin' => $data
        ]]);
        }
       }

       catch


    }
}
