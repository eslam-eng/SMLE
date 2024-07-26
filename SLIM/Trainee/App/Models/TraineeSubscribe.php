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
    protected $fillable = [
        'package_id',
        'trainee_id',
        'package_type', 'is_paid',
        'payment_method', 'amount',
        'invoice_file', 'quizzes_count', 'num_available_question',
        'start_date', 'end_date', 'remaining_quizzes',
        'is_active', 'for_all_specialities', 'subscribe_status'];

    protected static function newFactory(): TraineeSubscribeFactory
    {
        //return TraineeSubscribeFactory::new();
    }

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

//    public function specialists(): HasManyThrough
//    {
//        return $this->hasManyThrough(Specialization::class,TraineeSubscribeSpecialize::class,'trainee_subscribe_id','id','id','specialist_id');
//    }
}
