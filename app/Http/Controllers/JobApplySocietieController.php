<?php

namespace App\Http\Controllers;

use App\Models\JobApplyPosition;
use App\Models\JobApplySocietie;
use App\Models\Societie;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobApplySocietieController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'vacancy_id' => 'required',
                'positions' => 'required',
                'note' => 'required'
            ]);

            $token = Societie::where('login_tokens' , $request->token)->first();

            $societie = JobApplySocietie::create([
                'job_vacancy_id' => $request->vacancy_id,
                'society_id' => $token->id,
                'notes' => $request->notes
            ]);

            $job = JobApplyPosition::create([
                'job_vacancy_id' => $request->vacancy_id,
                'position_id' => $request->positions,
                'job_apply_societies_id' => $societie->id,
                'data' => now()
            ]);

            return response()->json(['data' => $societie , "datrav2" => $job]);
        }

        catch(ValidationException $e)
        {
            return;
        }
    }
}
