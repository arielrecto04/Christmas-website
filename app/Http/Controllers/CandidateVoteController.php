<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\CandidateVote;
use App\Models\SurveyCandidate;

class CandidateVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $surveys = Survey::get();

        return view('vote', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        dd($request->all());

        $user = auth()->user();



        $candidateUser = SurveyCandidate::find($id);


        $alreadyVoted = CandidateVote::where('user_id', $user->id)
            ->where('candidate_id', $candidateUser->id)
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'You have already voted for this candidate.');
        }

        $vote = CandidateVote::create([
            'user_id' => $user->id,
            'survey_candidate_id' => $candidateUser->id, 
        ]);


        return back()->with('message', "You voted for {$candidateUser->user->name}");
    }


    /**
     * Display the specified resource.
     */
    public function show(CandidateVote $candidateVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CandidateVote $candidateVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CandidateVote $candidateVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidateVote $candidateVote)
    {
        //
    }
}
