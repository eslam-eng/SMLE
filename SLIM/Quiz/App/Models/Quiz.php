<?php

namespace SLIM\Quiz\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Question\App\Models\Question;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\App\Models\SubSpecialties;
use SLIM\Trainee\App\Models\Trainee;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function specialist()
    {
        return $this->belongsToMany(Specialization::class, 'quiz_specialist', 'quiz_id', 'specialist_id');
    }

    public function Subspecialist()
    {
        return $this->belongsToMany(SubSpecialties::class, 'quiz_sub_specialist', 'quiz_id', 'sub_specialist_id');
    }

    public function listQuestions()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'quiz_id', 'question_id')
            ->withPivot('is_correct', 'answer', 'user_answer');
    }

    public function answerdQuestions()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'quiz_id', 'question_id')
            ->wherePivot('is_correct', 1)
            ->withPivot('is_correct', 'answer', 'user_answer');
    }

    public function unanswerdQuestions()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'quiz_id', 'question_id')
            ->wherePivot('is_correct', null)
            ->withPivot('is_correct', 'answer', 'user_answer');
    }

    public function correctAnswers()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'quiz_id', 'question_id')
            ->wherePivot('is_correct', 1);
    }

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    public function getLevelTextAttribute()
    {
        return match ($this->level) {
            1 => 'easy',
            2 => 'intermediate',
            3 => 'difficult',
            default => '-'
        };
    }


    public function inCorrectAnswers()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'quiz_id', 'question_id')
            ->wherePivot('is_correct', 0);

    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }
}
