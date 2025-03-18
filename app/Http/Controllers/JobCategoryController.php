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

            $vacancies = JobVacancie::with('category', 'avaliable')->get();
            $data = []; // Buat array kosong

            foreach ($vacancies as $vacancie) {
                $data[] = [
                    'id' => $vacancie->id,
                    'category' => $vacancie->category,
                    'Company' => $vacancie->company,
                    'address' => $vacancie->address,
                    'description' => $vacancie->description,
                    'avaliable_position' => $vacancie->avaliable ? [
                        'position' => $vacancie->avaliable->position,
                        'capacity' => $vacancie->avaliable->capacity,
                        'apply_capacity' => $vacancie->avaliable->apply_capacity
                    ] : null
                ];
            }

            return response()->json(['vacancies' => $data]); // Return setelah loop selesai
        }
        catch (ValidationException $e) {
            return response()->json(['message' => "Unauthorized user"], 401);
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
