<?php

namespace App\Http\Controllers;

use App\Models\JobApplyPosition;
use App\Models\JobApplySocietie;
use App\Models\Societie;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobApplySocietieController extends Controller
{
    public function store(Request $request)
    {
        try {
            $credentials = $request->validate([
                'vacancy_id' => 'required',
                'positions' => 'required',
                'notes' => 'required'
            ]);

            $token = Societie::where('login_tokens' , $request->token)->first();
            $valid = JobApplySocietie::where('society_id' , $token->id)->get();
            $validation = Validation::where('society_id' , $token->id)->get();
            if($validation->status !== 'pending')
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

                return response()->json(['message' => 'Applying for job successful']);
            }
            else {
                return response()->json(['message' => 'Application for a job can only be once']);
            }
        } else {
            return response()->json(['message' => 'Your data validator must be accepted by validator before']);
        }
        }

        catch(ValidationException $e)
        {
            return response()->json(['message' => $e->errors()]);
        }
    }
}
