<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'sex',
        'address',
        'email',
        'phone',
        'diagnosis',
        'empathy_score',
        'mood_state',
        'empathy_trend',
        'notes',
        'avatar_initials',
    ];

    protected $casts = [
        'age'           => 'integer',
        'empathy_score' => 'integer',
        'empathy_trend' => 'string',
    ];

    public function getEmpathyLabelAttribute(): string
    {
        if ($this->empathy_score >= 75) return 'High Empathy';
        if ($this->empathy_score >= 40) return 'Moderate Empathy';
        return 'Low Empathy';
    }

    public function getEmpathyColorAttribute(): string
    {
        if ($this->empathy_score >= 75) return 'amber';
        if ($this->empathy_score >= 40) return 'blue';
        return 'red';
    }

    public function getMoodIconAttribute(): string
    {
        return match($this->mood_state) {
            'Calm'       => '😌',
            'Anxious'    => '😰',
            'Joyful'     => '😊',
            'Melancholic'=> '😔',
            'Distressed' => '😣',
            default      => '😐',
        };
    }

    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', $this->name);
        $init  = strtoupper(substr($parts[0], 0, 1));
        if (isset($parts[1])) $init .= strtoupper(substr($parts[1], 0, 1));
        return $init;
    }
}