<?php

namespace SLIM\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SLIM\Setting\App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::orderby('id', 'desc')->first();

        return view('setting::edit', compact('setting'));
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
        $settingRequest->validate([
            'web_icon' => 'nullable|image',
            'web_logo' => 'nullable|image',
        ]);
        if ($settingRequest->hasFile('web_icon')) {
            $currentImagePath = $setting->website_icon;

            // Check if the current image exists and delete it
            if ($currentImagePath && Storage::exists($currentImagePath)) {
                Storage::delete($currentImagePath);
            }
            // Store the image in the 'public/images' directory
            $filePath = $settingRequest->file('web_icon')->store('settings','public');

            $setting->logo = $filePath;
            $setting->save();
        }

        if ($settingRequest->hasFile('web_logo')) {
            $currentImagePath = $setting->logo;

            // Check if the current image exists and delete it
            if ($currentImagePath && Storage::exists($currentImagePath)) {
                Storage::delete($currentImagePath);
            }

            // Store the image in the 'public/images' directory
            $filePath = $settingRequest->file('web_logo')->store('settings','public');

            $setting->logo = $filePath;
            $setting->save();
        }

        $setting->update($settingRequest->except(['web_icon', 'web_logo']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
