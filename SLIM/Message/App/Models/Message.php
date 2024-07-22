<?php

namespace SLIM\Message\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SLIM\Message\Database\factories\MessageFactory;
use SLIM\Trainee\App\Models\Trainee;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['message', 'rate', 'is_read', 'trainee_id'];

    protected static function newFactory(): MessageFactory
    {
        //return MessageFactory::new();
    }


    public function trainee()
    {
        return $this->belongsTo(Trainee::class,'trainee_id');
    }
}
