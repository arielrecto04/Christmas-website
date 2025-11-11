<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Resources\SurveyResource;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('name', 'asc')
                      ->paginate(10);
        $surveys = SurveyResource::collection($surveys);
        return view('survey', compact('surveys'));
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Survey::create([
            'name' => $attribute['name'],
            'description' => $attribute['description'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'year' => date('Y'),
        ]);
        return back()->with('success', 'Vote submitted successfully!');
    }
}
