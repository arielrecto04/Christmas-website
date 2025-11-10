<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'date_year',
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
