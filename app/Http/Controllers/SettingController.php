<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.edit');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $data['date_system'] = $data['date_system'] ?? 0;

        // Check if the key 'date_system_value' exists before accessing it
        $data['date_system_value'] = isset($data['date_system_value']) ? $data['date_system_value'] : null;

        foreach ($data as $key => $value) {
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }

        return redirect()->route('settings.index');
    }
}