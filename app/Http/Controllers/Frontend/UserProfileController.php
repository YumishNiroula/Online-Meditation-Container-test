<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function index()
    {
        $authUser = auth()->user();
        $user = UserProfile::where('user_id', $authUser->id)->first();
        $logs = Log::where('user_id', $authUser->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.meditation', ['user' => $user, 'logs' => $logs]);
    }

    public function updateUser(Request $request, $userId)
    {
        $user = UserProfile::where('user_id', $userId)->first();
        $user->username = $request->input('username') ?? $user->username;
        $user->first_name = $request->input('first_name') ?? $user->first_name;
        $user->last_name = $request->input('last_name') ?? $user->last_name;
        $user->birthdate = $request->input('birthday') ?? $user->birthdate;
        $user->save();

        if ($request->has('email') || $request->has('password') || $request->has('first_name') || $request->has('last_name')) {
            $user = User::findOrFail($userId);
            $user->email = $request->input('email') ?? $user->email;
            if ($request->has('password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name') ?? $user->name;
            $user->save();
        } else {
            $user = User::findOrFail($userId);
            $user->email = $request->input('email') ?? $user->email;
            $user->save();
        }

        return redirect()->route('frontend.home');
    }
}
