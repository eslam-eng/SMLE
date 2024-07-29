<?php

namespace SLIM\Category\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Category\Database\factories\CategoryFactory;
use SLIM\Question\App\Models\QuestionCategory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = ['name', 'color', 'num_question', 'is_active'];


    public function questionCategory()
    {
        return $this->hasMany(QuestionCategory::class, 'category_id');
    }


}
