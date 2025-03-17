<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobVacancie;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    public function index()
    {
        $category = JobVacancie::with('category')->get();
        dd($category);
    }
}
