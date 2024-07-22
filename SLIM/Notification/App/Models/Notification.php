<?php

namespace SLIM\Notification\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SLIM\Notification\Database\factories\NotificationFactory;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'notification'];

    protected static function newFactory(): NotificationFactory
    {
        //return NotificationFactory::new();
    }
}
