<?php

namespace App\Http\Controllers;

use App\Models\CandidateVote;
use Illuminate\Http\Request;

class CandidateVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vote');
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
