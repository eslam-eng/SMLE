<?php

namespace SLIM\Trainee\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use SLIM\Category\App\Models\Category;
use SLIM\Message\App\Models\Message;
use SLIM\Package\App\Models\Package;
use SLIM\Question\App\Models\Question;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\App\Models\SubSpecialties;
use SLIM\Trainee\Database\factories\TraineeFactory;

class Trainee extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    public const PAYMENT_TYPE = [
        'm' => 'monthly',
        'y' => 'Yearly',
        'p' => 'permanent'
    ];
    public const PAID_STATUS = [
        0 => 'Not Paid',
        1 => 'Paid'
    ];

    public const ACTIVE_STATUS = [
        0 => 'Not Active',
        1 => 'Active'
    ];

    protected $fillable = ['full_name', 'email', 'phone', 'user_name', 'degree', 'password', 'is_active',
        'specialist_id', 'category_id', 'sub_specialist_id', 'phone_code'];

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function specialist()
    {
        return $this->belongsTo(Specialization::class, 'specialist_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_specialist()
    {
        return $this->belongsTo(SubSpecialties::class, 'sub_specialist_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'trainee_subscribes', 'trainee_id', 'package_id');
        //->withPivot('package_type', 'is_paid', 'payment_method', 'amount',
        //                'invoice_file', 'start_date', 'end_date', 'is_active', 'for_all_specialities')
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'trainee_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'trainee_id');
    }

    public function ClassifiedQuestions()
    {
        return $this->belongsToMany(Question::class, 'question_category', 'trainee_id', 'question_id')->withPivot('id', 'category_id', 'quiz_id')
            ->withTimestamps();
    }

    public function Notesquestions()
    {
        return $this->belongsToMany(Question::class, 'question_notes', 'trainee_id', 'question_id')->withPivot('id', 'quiz_id', 'note')
            ->withTimestamps();
    }

    public function QuestionAnswer()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'trainee_id', 'question_id')->withPivot('id', 'answer', 'is_correct')
            ->withTimestamps();
    }

    public function Suggestsquestions()
    {
        return $this->belongsToMany(Question::class, 'question_suggests', 'trainee_id', 'question_id')->withPivot('id', 'quiz_id', 'suggest')
            ->withTimestamps();
    }

    public function subscribes()
    {
        return $this->hasMany(TraineeSubscribe::class, 'trainee_id');
    }

    public function activeSubscribe(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TraineeSubscribe::class, 'trainee_id')
            ->where('is_active', 1)->where('is_paid', 1)->latest('id');
    }

}
