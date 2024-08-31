<?php

namespace SLIM\Payment\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SLIM\Payment\Database\factories\PaymentFactory;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active','additional_data'];

    protected $casts = [
      'additional_data' => 'array'
    ];

    protected static function newFactory(): PaymentFactory
    {
        //return PaymentFactory::new();
    }
}
