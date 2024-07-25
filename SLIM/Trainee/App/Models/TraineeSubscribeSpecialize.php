<?php

namespace SLIM\Trainee\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SLIM\Package\App\Models\Package;
use SLIM\Specialization\App\Models\Specialization;

class TraineeSubscribeSpecialize extends Model
{
    use HasFactory;

    protected $fillable = ['trainee_subscribe_id','package_id', 'specialist_id'];

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialist_id');
    }

    public function traineeSubscribe(): BelongsTo
    {
        return $this->belongsTo(TraineeSubscribe::class, 'trainee_subscribe_id');
    }

}
