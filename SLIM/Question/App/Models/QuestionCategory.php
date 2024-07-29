<?php

namespace SLIM\Question\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;

    protected $table = 'question_category';
    protected $fillable = ['question_id', 'category_id', 'trainee_id', 'quiz_id'];
}
