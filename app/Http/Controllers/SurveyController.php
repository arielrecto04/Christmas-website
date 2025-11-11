<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        return view('survey');
    }

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
            'is_active' => true,
            'year' => Carbon::now()->year,
        ]);

        return redirect()->route('survey')->with(['message' => 'Survey created successfully']);
    }


    public function update(Request $request, string $id)
    {
        $survey = Survey::findOrFail($id);

        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'year' => 'required|digits:4|integer',
        ]);

        $survey->update([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
        ]);

        return redirect()->route('survey')->with('message', 'Survey updated successfully');
    }

    public function destroy(string $id)
    {
        $survey = Survey::findOrFail($id);

        if(!$survey->delete()) {
            return back()->with('message', 'Survey delete failed');
        }
        
        return redirect()->route('survey')->with('message', 'Survey deleted successfully');
    }
}
