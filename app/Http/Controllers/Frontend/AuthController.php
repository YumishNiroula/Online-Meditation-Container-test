<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\ClearCacheJob;
use App\Models\Log;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        ClearCacheJob::dispatch();

        // check if user is already logged in
        if (Auth::check()) {
            return redirect()->route('frontend.home');
        } else {
            return view('auth.login');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            Log::create([
                'user_id' => Auth::id(),
                'login_time' => date('H:i:s'),
            ]);

            return redirect()->route('frontend.home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userid = $user->id;

        $username = explode('@', $request->email)[0];
        $username = UserProfile::firstOrCreate([
            'user_id' => $userid,
            'username' => $username,
        ]);

        $user->assignRole(2);

        ClearCacheJob::dispatch();

        Auth::login($user);

        Log::create([
            'user_id' => Auth::id(),
            'login_time' => date('H:i:s'),
        ]);

        return redirect()->route('frontend.main');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.main');
    }
}
