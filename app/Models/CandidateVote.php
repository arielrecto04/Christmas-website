<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateVote extends Model
{
    protected $fillable = [
        'user_id',
        'survey_candidate_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidate()
    {
        return $this->belongsTo(SurveyCandidate::class, 'survey_candidate_id');
    }
}
