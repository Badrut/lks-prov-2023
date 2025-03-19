<?php

namespace App\Http\Controllers;

use App\Models\JobApplySocietie;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobVacancieController extends Controller
{
    public function check(Request $request)
    {

        $apply = JobApplySocietie::with('societie')->get();
        return response()->json(['data' => $apply]);
    }
}
