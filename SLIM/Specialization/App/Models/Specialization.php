<?php

namespace SLIM\Specialization\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Package\App\Models\Package;
use SLIM\Question\App\Models\Question;
use SLIM\Specialization\Database\factories\SpecializationFactory;
use SLIM\Subspecialties\App\Models\SubSpecialties;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Trainee\App\Models\TraineeSubscribe;

class Specialization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'number_question', 'number_user', 'is_active'];

    protected static function newFactory(): SpecializationFactory
    {
        //return SpecializationFactory::new();
    }

    public function trainees()
    {
        return $this->hasMany(Trainee::class, 'specialist_id');
    }

    public function subscribes()
    {
        return $this->hasMany(TraineeSubscribe::class, 'specialist_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'specialist_id');
    }

    public function subSpecialist()
    {
        return $this->hasMany(SubSpecialties::class, 'specialist_id');
    }
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'packages_specialities','specialist_id', 'package_id')
            ->withPivot('monthly_price', 'yearly_price');
    }

}
