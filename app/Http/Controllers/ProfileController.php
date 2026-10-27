<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $request->user()->forceFill([
            'password' => Hash::make($request->validated('password')),
        ])->save();

        $request->session()->regenerate();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Password berhasil diperbarui.');
    }
}