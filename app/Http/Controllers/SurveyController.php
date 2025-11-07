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
            'is_active' => 'boolean',
            'year' => 'required'
        ]);

        Survey::create([
            'name' => $attribute['name'],
            'description' => $attribute['description'] ?? null,
            'is_active' => true,
            'date_year' => $attribute['year'],
        ]);
    }
}
