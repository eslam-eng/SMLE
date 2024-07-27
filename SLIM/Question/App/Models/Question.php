<?php

namespace SLIM\Question\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SLIM\Abbreviation\App\Models\Abbreviation;
use SLIM\Question\Database\factories\QuestionFactory;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\App\Models\SubSpecialties;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'question', 'answer_a', 'answer_b', 'answer_c', 'answer_d','model_answer','question_mark',
        'description', 'image', 'is_active','specialist_id', 'sub_specialist_id','level'
    ];


    public function specialist()
    {
        return $this->belongsTo(Specialization::class,'specialist_id');
    }
    public function sub_specialist()
    {
        return $this->belongsTo(SubSpecialties::class,'sub_specialist_id');
    }

    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, 'quiz_question', 'question_id', 'quiz_id')
            ->withPivot('is_correct', 'answer','user_answer');
    }
    public function abbreviations()
    {
        return $this->belongsToMany(Abbreviation::class, 'abbreviation_question', 'question_id', 'abbreviation_id');

    }

}
