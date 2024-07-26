<?php

namespace SLIM\Quiz\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Question\App\Models\Question;
use SLIM\Trainee\App\Models\Trainee;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $table = 'quiz_question';

    protected $fillable = ['answer', 'user_answer', 'is_correct', 'quiz_id', 'question_id', 'trainee_id'];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
