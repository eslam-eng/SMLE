<?php

namespace SLIM\Trainee\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SLIM\Package\App\Models\Package;
use SLIM\Trainee\Database\factories\TraineeSubscribeFactory;

class TraineeSubscribe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): TraineeSubscribeFactory
    {
        //return TraineeSubscribeFactory::new();
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
