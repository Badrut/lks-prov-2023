<?php

namespace App\Http\Controllers;


use App\Models\Societie;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ValidationController extends Controller
{

    public function index(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required'
            ]);
            $scoiety = Societie::where('login_tokens' , $request->token)->first();
            $validation = Validation::where('society_id' , $scoiety->id)->first();

            $data = [
                // data id
                "status" => $validation->status,
                "work_experience" => $validation->work_experience,
                "job_category_id"=> $validation->job_category_id,
                "job_position" => $validation->job_position,
                "reason_accepted" => $validation->reason_accepted,
                "validator_notes"=> $validation->validator_notes,
                "validator" => $validation->validator
            ];

            return response()->json(['validation' => $data] , 200);
        }
        catch(ValidationException $e)
        {
            return response()->json(['message' => "Unauthorized user" ] , 401);
        }
    }

    public function sent(Request $request)
    {
        try {

            $scoiety = Societie::where('login_tokens' , $request->token)->first();
            $id = $scoiety->id;
            $request->validate([
                'token' => 'required',
            ]);

            Validation::create([
                'society_id' => $id,
                'work_experience' => $request->work_experience,
                'job_category_id' => $request->job_category_id,
                'job_position' => $request->job_position,
                'reason_accepted' => $request->reason_accepted
            ]);

            return response()->json(['messsage' => "Request data validation sent successful"] , 200);
        }

        catch(ValidationException $e)
        {
            return response()->json(['message' => "Unauthorized user" ] , 401);
        }
    }
}
