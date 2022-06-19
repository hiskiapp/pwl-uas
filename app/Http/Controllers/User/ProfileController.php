<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\ProfileRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = User::find(auth()->id());

        return view('user.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @return Application|RedirectResponse|Response|View
     */
    public function update(ProfileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::find(auth()->id());
        $patch = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($user->email !== $request->email) {
            $patch['email_verified_at'] = NULL;
        }

        $user->update($patch);

        return back()->with([
            'status' => 'success',
            'message' => 'Berhasil memperbarui data!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Application|Factory|View
     */
    public function showPasswordForm()
    {
        return view('user.profile.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PasswordRequest $request
     * @return RedirectResponse
     */
    public function password(PasswordRequest $request): RedirectResponse
    {
        User::find(auth()->id())->update(['password' => $request->password]);

        return back()->with([
            'status' => 'success',
            'message' => 'Berhasil memperbarui password!'
        ]);
    }
}
