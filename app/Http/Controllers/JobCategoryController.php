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
            return response()->json(['vacancies' => $vacancies]);
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

        return response()->json(['vacancies' => $vacancie]);
       }

       catch(ValidationException $e)
       {
           return response()->json(['message' => "Unauthorized user" ] , 401);
       }


    }
}
