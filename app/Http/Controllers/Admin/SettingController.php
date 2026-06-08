<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\AppSetting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        
        foreach ($settings as $key => $value) {
            \App\Models\AppSetting::where('key', $key)->update([
                'value' => $value,
                'updated_by' => auth()->guard('admin')->id()
            ]);
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
