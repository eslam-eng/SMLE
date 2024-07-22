<?php

namespace SLIM\Setting\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Setting\App\Models\Setting;
use SLIM\Traits\GeneralTrait;

class SettingController extends Controller
{
    use GeneralTrait;

    public function QuizSetting()
    {
        $setting = Setting::
        select('is_difficult', 'timer' ,'automatic_correct' ,'try_answer')
       ->orderby('id','desc')->first();
        return $this->returnDate($setting,'Setting Quiz');
    }

    public function AppSetting()
    {
        $setting = Setting::
        select('app_name', 'about_app', 'phone', 'whatsapp','email','facebook','youtube','linked_in',
            'url_play_store','url_apple_store'
            )
       ->orderby('id','desc')->first();
        return $this->returnDate($setting,'App Quiz');
    }
}
