<?php

namespace SLIM\Trainee\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SLIM\Package\App\Models\Package;
use SLIM\Trainee\Database\factories\TraineeSubscribeFactory;

class TraineeSubscribe extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'package_id',
        'trainee_id',
        'package_type', 'is_paid',
        'payment_method', 'amount',
        'invoice_file', 'quizzes_count', 'num_available_question',
        'start_date', 'end_date', 'remaining_quizzes',
        'is_active', 'for_all_specialities', 'subscribe_status'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function tranineeSubscribeSpecialization()
    {
        return $this->hasMany(TraineeSubscribeSpecialize::class, 'trainee_subscribe_id');
    }

}
