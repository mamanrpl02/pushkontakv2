<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
            ],
            [
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Format email tidak valid!',
            ]
        );

        // Pastikan reset password menggunakan model Member
        $status = Password::broker('member')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with('status', 'Kami telah mengirimkan tautan reset password ke email Anda!')
        : back()->withErrors(['email' => 'Email tidak ditemukan di sistem kami!']);
    }
}
