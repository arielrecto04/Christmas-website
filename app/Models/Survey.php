<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'year',
    ];

    public function votes()
    {
        return $this->hasMany(CandidateVote::class);
    }

    public function candidates()
    {
        return $this->hasMany(SurveyCandidate::class);
    }
}
