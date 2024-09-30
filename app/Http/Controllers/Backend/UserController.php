<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        $roles = Role::all()->pluck('name');

        return view('backend.settings.users.index', ['users' => $users, 'roles' => $roles]);
    }

    public function saveThemeData(Request $request)
    {
        $loggedUser = Auth::user();

        $user = User::find($loggedUser->id);
        $user->theme = $request->theme;
        $user->save();

        return response()->json(['success' => 'Theme data saved successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:8',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/user_avatar'), $filename);
            $user['image'] = $filename;
        }

        $user->assignRole($request->role);

        $user->save();

        $notifications = array(
            'message' => 'User added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users.index')->with($notifications);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $logUser = Auth::user();
        $check = $logUser->roles->pluck('name')->contains("Super Admin");
        $check2 = $logUser->roles->pluck('name')->contains("Admin");
        $userRole = $user->roles->pluck('name');

        $notifications = array(
            'message' => 'You are not authorized to edit this user!',
            'alert-type' => 'error'
        );

        if ($check) {
            $roles = Role::all()->pluck('name');
        } else if ($check2) {
            $roles = Role::whereNotIn('name', [$userRole, 'Super Admin'])->pluck('name');
        } else {
            $roles = Role::whereNotIn('name', [$userRole, 'Super Admin', 'Admin'])->pluck('name');
        }


        if ($userRole->contains("Super Admin") && !$check) { // if user is not super admin but change request is for super admin

            return redirect()->route('users.index')->with($notifications);
        } else if (!$check && !$check2 && $userRole->contains("Admin")) { // if user is not super admin or admin but change request is for admin

            return redirect()->route('users.index')->with($notifications);
        } else {
            return view('backend.settings.users.edit', ['user' => $user, 'roles' => $roles, 'userRole' => $userRole]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'nullable',
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        $request->password == null ? null : $user->password = bcrypt($request->password);

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('uploads/user_avatar/' . $user->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/user_avatar'), $filename);
            $user['image'] = $filename;
        }

        $user->save();

        if (!$user->roles->isEmpty()) {
            $request->role == null ? null : $user->syncRoles($request->role);
        } else {
            $request->role == null ? null : $user->assignRole($request->role);
        }

        Artisan::call('cache:forget spatie.permission.cache');

        $notifications = array(
            'message' => 'User updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $logUser = Auth::user();
        $check = $logUser->roles->pluck('name')->contains("Super Admin");
        $check2 = $logUser->roles->pluck('name')->contains("Admin");
        $userRole = $user->roles->pluck('name');

        $notifications = array(
            'message' => 'User deleted successfully!',
            'alert-type' => 'warning'
        );

        $error = array(
            'message' => 'You are not authorized to delete this user!',
            'alert-type' => 'error'
        );

        if ($check) {
            if ($userRole->contains("Super Admin") && $user->id == 1) {

                return redirect()->route('users.index')->with($error);
            } else if ($userRole->contains("Super Admin") && $user->id !== 1) {

                if ($user->image != null) {
                    unlink(public_path('uploads/user_avatar/' . $user->image));
                }
                $user->delete();
                return redirect()->route('users.index')->with($notifications);
            } else {

                if ($user->image != null) {
                    unlink(public_path('uploads/user_avatar/' . $user->image));
                }
                $user->delete();

                return redirect()->route('users.index')->with($notifications);
            }
        } else if ($check2) {
            if ($userRole->contains("Super Admin")) {

                return redirect()->route('users.index')->with($error);
            } else {

                if ($user->image != null) {
                    unlink(public_path('uploads/user_avatar/' . $user->image));
                }
                $user->delete();

                return redirect()->route('users.index')->with($notifications);
            }
        } else {
            if ($userRole->contains("Super Admin") || $userRole->contains("Admin")) {

                return redirect()->route('users.index')->with($error);
            } else {
                if ($user->image != null) {
                    unlink(public_path('uploads/user_avatar/' . $user->image));
                }

                $user->delete();
                return redirect()->route('users.index')->with($notifications);
            }
        }
    }
}
