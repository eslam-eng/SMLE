<?php

namespace SLIM\Category\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SLIM\Category\Database\factories\CategoryFactory;
use SLIM\Specialization\App\Models\Specialization;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = ['name', 'color', 'num_question', 'is_active'];

    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }




}
