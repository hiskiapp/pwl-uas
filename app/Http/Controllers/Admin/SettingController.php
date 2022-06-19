<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $setting = Setting::findOrFail($id);

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        Setting::findOrFail($id)->update([
            'value' => $request->value
        ]);

        return redirect()->route('admin.settings.index')->with([
            'status' => 'success',
            'message' => 'Pengaturan berhasil diedit!'
        ]);
    }
}
