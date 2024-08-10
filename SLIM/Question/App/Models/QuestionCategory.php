<?php

namespace SLIM\Question\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Category\App\Models\Category;
use SLIM\Trainee\App\Models\Trainee;

class QuestionCategory extends Model
{
    use HasFactory;

    protected $table = 'question_category';
    protected $fillable = ['question_id', 'category_id', 'trainee_id', 'quiz_id'];

    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function trainee(){
        return $this->belongsTo(Trainee::class,'trainee_id');
    }
}
