<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role         = $role;
        $this->permission   = $permission;
    }

    // list all role

    public function index()
    {
        $listRole   = $this->role->all();

        return      view('role.index', compact('listRole'));

    }

    /**
     * show form create role
     */

    public function create()
    {
        $permissions    = $this->permission->all();

        return          view('role.add', compact('permissions'));

    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            // Insert data to role table

            $roleCreate     = $this->role->create([

                'name'          => $request->name,
                'display_name'  => $request->display_name
            ]);

            // Insert data to role_permission

            $roleCreate->permissions()->attach($request->permission);

            DB::commit();

            return redirect()->route('role.index');
        }
        catch (\Exception $exception) {

            DB::rollBack();

            \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        }
    }


    public function edit($id)
    {
        $permissions = $this->permission->all();
        $role = $this->role->findOrfail($id);
        $getAllPermissionOfRole = DB::table('role_permission')->where('role_id', $id)->pluck('permission_id');
        return view('role.edit', compact('permissions', 'role', 'getAllPermissionOfRole'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            // update to role table
            $this->role->where('id', $id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);

            // update to role_permission table
            DB::table('role_permission')->where('role_id', $id)->delete();
            $roleCreate = $this->role->find($id);
            $roleCreate->permissions()->attach($request->permission);
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            // Delete role
            $role = $this->role->find($id);
            $role->delete($id);
            // Delete user of role_permission table
            $role->permissions()->detach();
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        }

    }
}
