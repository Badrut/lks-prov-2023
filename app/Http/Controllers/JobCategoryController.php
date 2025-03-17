<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobVacancie;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobCategoryController extends Controller
{
    public function index(Request $request)
    {
       try {
        $request->validate([
            'token' => 'required'
        ]);

        $vacancie = JobVacancie::with('category' , 'avaliable')->get();
        // kenapa tidak menggunakan with
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

       catch(ValidationException $e)
       {
           return response()->json(['message' => "Unauthorized user" ] , 401);
       }


    }

    public function show(Request $request , $id)
    {
       try {
        $request->validate([
            'token' => 'required'
        ]);

        $vacancie = JobVacancie::with('category' , 'avaliable')->where('id' , $id)->get();

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

       catch(ValidationException $e)
       {
           return response()->json(['message' => "Unauthorized user" ] , 401);
       }


    }
}
