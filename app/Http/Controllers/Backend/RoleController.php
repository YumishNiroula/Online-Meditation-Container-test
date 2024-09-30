<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $permissions = Permission::get();
        $roles = Role::all();

        return view('backend.settings.role.index', ['permissions' => $permissions, 'roles' => $roles]);
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
            'name' => 'required|unique:roles',
            'permission' => 'required',
        ]);

        $role = Role::create(['guard_name' => 'web', 'name' => $request->name]);
        $role->syncPermissions($request->permission);

        Artisan::call('cache:forget spatie.permission.cache');

        $notifications = [
            'message' => 'Role created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notifications);
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
    public function edit(Role $role)
    {
        if ($role->name == 'Super Admin') {
            $notifications = [
                'message' => 'You can\'t edit Super Admin Role!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notifications);
        }
        $permissions = Permission::get();
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('backend.settings.role.edit', ['role' => $role, 'rolePermissions' => $rolePermissions, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission' => 'required',
        ]);

        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permission);

        Artisan::call('cache:forget spatie.permission.cache');

        $notifications = [
            'message' => 'Role updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('roles.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->name == 'Super Admin') {

            $notifications = [
                'message' => 'You can not delete this role!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notifications);
        }
        $role->delete();

        Artisan::call('cache:forget spatie.permission.cache');

        $notifications = [
            'message' => 'Role deleted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('roles.index')->with($notifications);
    }
}
