<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'year' => 'required'
        ]);

        Survey::create([
            'name' => $attribute['name'],
            'description' => $attribute['description'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'date_year' => $attribute['year'],
        ]);
        return back()->with('success', 'Vote submitted successfully!');
    }
}
