<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteUserMail;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class InviteAdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Invites/Index', [
            'roles' => Role::query()->orderBy('name')->pluck('name')->values(),
            'invites' => Invite::query()
                ->latest()
                ->limit(20)
                ->get(['email','role_name','status','expires_at','accepted_at','created_at']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'role_name' => ['required', 'string', 'exists:roles,name'],
        ]);
        $existing = Invite::query()
            ->where('email', $data['email'])
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            Mail::to($existing->email)->send(new InviteUserMail($existing));
            return back()->with('success', 'Convite reenviado!');
        }

        $invite = Invite::create([
            'email' => $data['email'],
            'token' => Str::random(64),
            'status' => 'pending',
            'role_name' => $data['role_name'],
            'expires_at' => now()->addDays(2),
        ]);

        Mail::to($invite->email)->send(new InviteUserMail($invite));

        return back()->with('success', 'Convite enviado!');
    }
}
