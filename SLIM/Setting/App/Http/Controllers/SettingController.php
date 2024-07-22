<?php

namespace SLIM\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Setting\App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::orderby('id','desc')->first();

        return view('setting::edit',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $settingRequest, Setting $setting)
    {
        if($settingRequest->hasFile('web_icon'))
        {
            $settingRequest->web_icon->storeAs('public/setting/',$settingRequest->web_icon->HashName());
            $settingRequest['website_icon']='storage/setting/'.$settingRequest->web_icon->HashName();
        }
        else
        {
            $settingRequest['website_icon']=$setting->website_icon;
        }

        if($settingRequest->hasFile('web_logo'))
        {
            $settingRequest->web_logo->storeAs('public/setting/',$settingRequest->web_logo->HashName());
            $settingRequest['logo']='storage/setting/'.$settingRequest->web_logo->HashName();
        }
        else
        {
            $settingRequest['logo']=$setting->logo;
        }



        $setting->update($settingRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
