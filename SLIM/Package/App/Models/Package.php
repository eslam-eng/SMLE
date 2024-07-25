<?php

namespace SLIM\Package\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SLIM\Package\Database\factories\PackageFactory;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Trainee\App\Models\TraineeSubscribeSpecialize;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'monthly_price', 'yearly_price',
        'no_limit_for_quiz', 'no_limit_for_question', 'for_all_specialities',
        'num_available_quiz', 'num_available_question', 'is_active', 'description',
    ];

    protected static function newFactory(): PackageFactory
    {
        //return PackageFactory::new();
    }

    public function specialist()
    {
        return $this->belongsToMany(Specialization::class, 'packages_specialities', 'package_id', 'specialist_id')
            ->withPivot('monthly_price', 'yearly_price');
    }

    public function specialists()
    {
        return $this->hasMany(PackageSpecialist::class, 'package_id');
    }

    public function activeTraineeSubscribeSpecialists(): HasMany
    {
        return $this->hasMany(TraineeSubscribeSpecialize::class, 'package_id');
    }

}
