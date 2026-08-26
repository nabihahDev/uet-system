<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update or upload the user's signature image and approval PIN.
     */
    public function updateSignature(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'signature' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'approval_pin' => ['nullable', 'digits:4', 'confirmed'],
        ]);

        // 1. Handle Signature Image Upload
        if ($request->hasFile('signature')) {
            if ($user->signature_path && Storage::disk('public')->exists($user->signature_path)) {
                Storage::disk('public')->delete($user->signature_path);
            }

            $path = $request->file('signature')->store('signatures', 'public');
            $user->signature_path = $path;
        }

        // 2. Update Approval PIN
        // Automatic hashing via User Model casting ('approval_pin' => 'hashed')
        if ($request->filled('approval_pin')) {
            $user->approval_pin = $request->approval_pin;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'signature-updated');
    }

    /**
     * Delete the user's signature image.
     */
    public function destroySignature(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->signature_path && Storage::disk('public')->exists($user->signature_path)) {
            Storage::disk('public')->delete($user->signature_path);
        }

        $user->signature_path = null;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'signature-deleted');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->signature_path && Storage::disk('public')->exists($user->signature_path)) {
            Storage::disk('public')->delete($user->signature_path);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}