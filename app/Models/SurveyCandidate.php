<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyCandidate extends Model
{
    protected $fillable = [
        'survey_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function votes()
    {
        return $this->hasMany(CandidateVote::class, 'survey_candidate_id');
    }
}
