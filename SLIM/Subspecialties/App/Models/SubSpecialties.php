<?php

namespace SLIM\Subspecialties\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Question\App\Models\Question;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\Database\factories\SubspecialtiesFactory;
use SLIM\Trainee\App\Models\Trainee;

class SubSpecialties extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'number_question', 'number_user', 'is_active', 'specialist_id'];


    public function specialist()
    {
        return $this->belongsTo(Specialization::class, 'specialist_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'sub_specialist_id');
    }


    public function trainees()
    {
        return $this->hasMany(Trainee::class, 'sub_specialist_id');
    }

}
