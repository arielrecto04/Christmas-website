<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'year',
    ];

    public function getYear()
    {
        return Carbon::now()->year;
    }

    public function votes()
    {
        return $this->hasMany(CandidateVote::class);
    }

    public function candidates()
    {
        return $this->hasMany(SurveyCandidate::class);
    }
}
