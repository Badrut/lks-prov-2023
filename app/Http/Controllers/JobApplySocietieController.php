<?php

namespace App\Http\Controllers;

use App\Models\AvailablePosition;
use App\Models\JobApplyPosition;
use App\Models\JobApplySocietie;
use App\Models\JobVacancie;
use App\Models\Societie;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use const Dom\VALIDATION_ERR;

class JobApplySocietieController extends Controller
{

    public function index(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required'
            ]);

            $vacancie = JobVacancie::with('category' , 'avaliable' , 'jobApplyPosition' , 'jobApplySocietie')->get();
            foreach ($vacancie as $v)
            {
                // $data = [
                //     'position' => $v->avaliable->position,
                //     'status' => $v->jobApplyPosition->status,
                //     'notes' => $v->jobApplySocietie->notes
                // ];
                return response()->json(['vacancie' =>
            [
                // 'id' => $v->id,
                // 'category' => $v->category,
                // 'Company' => $v->company,
                // 'address' => $v->address,
                // 'position' => $data
                $vacancie
            ]
        ]);
            }
           }

           catch(ValidationException $e)
           {
               return response()->json(['message' => "Unauthorized user" ] , 401);
           }


    }

    public function store(Request $request)
    {
        try {
            $credentials = $request->validate([
                'vacancy_id' => 'required',
                'positions' => 'required',
            ]);



            $token = Societie::where('login_tokens' , $request->token)->first();
            $valid = JobApplySocietie::where('society_id' , $token->id)->first();
            $validation = Validation::where('society_id' , $token->id)->first();
            if ($validation?->status !== 'pending')
            {
                if(is_null($valid))
                {
                    $societie = JobApplySocietie::create([
                        'job_vacancy_id' => $request->vacancy_id,
                        'society_id' => $token->id,
                        'notes' => $request->notes,
                        'date' => now()
                    ]);

                    $job = JobApplyPosition::create([
                        'job_vacancy_id' => $request->vacancy_id,
                        'position_id' => $request->positions,
                        'society_id' => $token->id,
                        'job_apply_societies_id' => $societie->id,
                        'date' => now()

                    ]);

                    $avaliable = AvailablePosition::findOrFail($request->positions);
                    $avaliable->apply_capacity += 1;
                    $avaliable->save();

                    return response()->json(['message' => 'Applying for job successful'] , 200);
                }
            else {
                return response()->json(['message' => 'Application for a job can only be once'] , 401);
            }
        } else {
            return response()->json(['message' => 'Your data validator must be accepted by validator before'] , 401);
        }
        }

        catch(ValidationException $e)
        {
            if (!$request->token) {
                return response()->json(['message' => 'Unauthorized user'], 401);
            } else {
                return response()->json(['message' => $e->errors()]);
            }

        }
    }
}
