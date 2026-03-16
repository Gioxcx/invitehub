<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class InviteController extends Controller
{
    public function show(string $token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        if ($invite->status !== 'pending') {
            abort(410, 'Invite is not available.');
        }

        if ($invite->expires_at && $invite->expires_at->isPast()) {
            abort(410, 'Invite has expired.');
        }

        return Inertia::render('Invites/Accept', [
            'invite' => [
                'email' => $invite->email,
                'token' => $invite->token,
                'role_name' => $invite->role_name,
            ],
        ]);
    }

    public function accept(Request $request, string $token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        if ($invite->status !== 'pending') {
            abort(410, 'Invite is not available.');
        }

        if ($invite->expires_at && $invite->expires_at->isPast()) {
            abort(410, 'Invite has expired.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (User::where('email', $invite->email)->exists()) {
            abort(409, 'User already exists.');
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $invite->email,
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($invite->role_name);

        $invite->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
