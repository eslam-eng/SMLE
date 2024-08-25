<?php

namespace SLIM\Setting\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SLIM\Setting\App\Models\Setting;
use SLIM\Traits\GeneralTrait;

class SettingController extends Controller
{
    use GeneralTrait;

    public function QuizSetting()
    {
        $setting = Setting::
        select(['is_difficult', 'timer', 'automatic_correct', 'try_answer'])
            ->orderby('id', 'desc')->first();
        return $this->returnData($setting, 'Setting Quiz');
    }

    public function AppSetting()
    {
        $setting = Setting::query()
            ->select(['app_name', 'logo', 'about_app', 'phone', 'whatsapp', 'email', 'facebook', 'youtube', 'linked_in', 'url_play_store', 'url_apple_store'])
            ->first();
        $setting->logo = asset('storage/'.$setting->logo);
        return $this->returnData($setting, 'App Quiz');
    }
}
