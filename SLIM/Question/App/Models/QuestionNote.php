<?php

namespace SLIM\Question\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Question\Database\factories\QuestionNoteFactory;
use SLIM\Trainee\App\Models\Trainee;

class QuestionNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    protected static function newFactory(): QuestionNoteFactory
    {
        //return QuestionNoteFactory::new();
    }
}
