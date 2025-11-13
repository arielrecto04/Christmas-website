<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::paginate(10);
        return view('survey', compact('surveys'));
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $survey = Survey::create([
            'name' => $attribute['name'],
            'description' => $attribute['description'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'year' => date('Y'),
        ]);

        if(!$survey) {
            return back()->with('error', 'Failed to create survey');
        }

        $candidates = User::has('attendance')->get();

        foreach ($candidates as $candidate) {
            $survey->candidates()->create([
                'user_id' => $candidate->id,
            ]);
        }

        return redirect()->route('christmas.surveys')->with(['message' => 'Survey created successfully']);
    }


    public function update(Request $request, string $id)
    {
        $survey = Survey::findOrFail($id);

        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $updateSurvey = $survey->update([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
        ]);

        if(!$updateSurvey) {
            return back()->with('error', 'Failed to update survey');
        }

        return redirect()->route('christmas.surveys')->with('message', 'Survey updated successfully');
    }

    public function destroy(string $id)
    {
        $survey = Survey::findOrFail($id);

        if(!$survey->delete()) {
            return back()->with('message', 'Failed to delete survey');
        }
        
        return redirect()->route('christmas.surveys')->with('message', 'Survey deleted successfully');
    }

    public function toggleActive($id)
    {
        $survey = Survey::findOrFail($id);

        $survey->update([
            'is_active' => !$survey->is_active,
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $survey->is_active,
        ]);
    }
}
