<?php

namespace SLIM\Setting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SLIM\Setting\Database\factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'app_name', 'about_app', 'logo', 'website_icon', 'phone', 'whatsapp','email','facebook','youtube','linked_in',
        'is_difficult','timer','automatic_correct','try_answer','question_timer','url_apple_store','url_play_store'
    ];



    protected static function newFactory(): SettingFactory
    {
        //return SettingFactory::new();
    }
}
