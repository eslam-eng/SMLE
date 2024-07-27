<?php

namespace SLIM\Package\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Package\Database\factories\PackageFactory;
use SLIM\Specialization\App\Models\Specialization;

class PackageSpecialist extends Model
{
    use HasFactory;

    protected $table = 'packages_specialities';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['specialist_id', 'package_id', 'monthly_price', 'yearly_price'];

    public function specialist()
    {
        return $this->belongsToMany(Specialization::class, 'packages_specialities', 'package_id', 'specialist_id')
            ->withPivot('monthly_price', 'yearly_price');
    }

}
