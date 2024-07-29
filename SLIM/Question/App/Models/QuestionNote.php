<?php

namespace SLIM\Question\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SLIM\Question\Database\factories\QuestionNoteFactory;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Trainee\App\Models\Trainee;

class QuestionNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['question_id', 'trainee_id','quiz_id','note'];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

}
