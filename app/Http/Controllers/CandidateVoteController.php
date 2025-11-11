<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\CandidateVote;

class CandidateVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->id();

        $surveys = Survey::with(['candidates.votes' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'candidates.user'])->paginate(10);
        
        $surveys->getCollection()->transform(function ($survey) {
            $voteCandidate = $survey->candidates->first(function ($candidate) {
                return $candidate->votes->isNotEmpty();
            });

            $survey->voted_candidate_name = $voteCandidate?->user?->name ?? 'Not Yet Voted';
            return $survey;
        });

        return view('vote', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
