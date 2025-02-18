<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:student,coach'],
            'gender' => ['required', 'string', 'in:male,female'],
            'telephone' => ['required', 'string', 'max:20'],
        ]);

        Log::info('Validation passed', $validated);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
            'telephone' => $request->telephone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Conditional redirect based on the user's role
        if ($user->role === 'student') {
            return redirect(RouteServiceProvider::HOME);
        } elseif ($user->role === 'coach') {
            return redirect(RouteServiceProvider::COACH);
        }

        // Fallback redirect if no specific role match is found
        return redirect(RouteServiceProvider::HOME);
    }
}
