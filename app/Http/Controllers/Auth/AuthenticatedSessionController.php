<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            // Sinkronisasi data user login ke tabel Pengguna
            $user = Auth::user();
            Pengguna::updateOrCreate(
                ['username' => $user->email],
                [
                    'nama_pengguna' => $user->name,
                    'username' => $user->email,
                    'password' => $user->password,
                    'role' => $user->role ?? 'karyawan',
                ]
            );

            // Log informasi login berhasil
            Log::info('User logged in successfully', ['user_id' => $user->id, 'username' => $user->email]);

            return redirect()->intended(RouteServiceProvider::HOME)
                ->with('success', 'Welcome back! You have been successfully logged in.');

        } catch (\Exception $e) {
            // Log error jika login gagal
            Log::error('Login attempt failed', [
                'error_message' => $e->getMessage(),
                'input' => $request->only('email')
            ]);

            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Invalid credentials. Please try again.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log informasi saat pengguna logout
        Log::info('User logged out successfully', ['user_id' => Auth::id()]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('status', 'You have been successfully logged out.');
    }
}
