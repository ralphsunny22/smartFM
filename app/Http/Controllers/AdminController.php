<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Folder;
use App\Models\MyFile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminDashboard()
    {
        $user = auth()->user();
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminFiles()
    {
        $user = auth()->user();
        $files = MyFile::all();
        return view('admin.adminFiles', compact('files'));
    }

    public function adminUsers()
    {
        $user = auth()->user();
        $users = User::all();
        return view('admin.adminUsers', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminFolders()
    {
        $user = auth()->user();
        $folders = Folder::all();
        return view('admin.adminFolders', compact('folders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminRoles()
    {
        $user = auth()->user();
        $roles = Role::all();
        return view('admin.adminRoles', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminAddRoles()
    {
        return view('admin.adminAddRoles');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //create roles
    public function adminAddRolesPost(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        foreach ($data['title'] as $key => $val) {
            if (!empty($val)) {
                //prevent duplicate title check
                // $attrCount = Role::where(['title' => $data['title'][$key]])->count();
                // if ($attrCount > 0) {
                //     return back()->with('error', '"' . $data['title'][$key] . '" Record already exists');
                // }
                $role = new Role;
                $role->name = $val;
                //$role->created_by = $user->id;
                $role->save();
            }
        }
        return redirect()->route('adminRoles')->with('success', 'Role Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminAddPermissions($role_id)
    {
        $role = Role::find($role_id);
        $permissions = $role->permissions;
        return view('admin.adminAddPermissions', compact('role', 'permissions'));
    }

    public function adminAddPermissionsPost(Request $request, $role_id)
    {
        $user = auth()->user();
        
        $role = Role::find($role_id);
        $data = $request->all();
        foreach ($data['title'] as $key => $val) {
            if (!empty($val)) {
                
                $permission = new Permission;
                $permission->name = $val;
                // $permission->slug = Str::slug($val);
                // $permission->role_id = $role_id;
                $permission->save();
            }
            $role->givePermissionTo($permission);
        }
        return back()->with('success', 'Permissions Added Successfully');
        
    }

    public function adminAssignUserRolePermission($user_id)
    {
        $user = User::find($user_id);
        //$permissions = $user->getPermissionsViaRoles(); //[1,2,3] not advisable
        //$permissions = $user->getAllPermissions(); ////[1,2,3] not advisable

        // get the names of the user's roles
        //return $roles = $user->getRoleNames(); // Returns a collection

        $user_permissions = $user->getDirectPermissions();
        $roles = Role::all();

        return view('admin.adminAssignUserRolePermission', compact('user', 'roles', 'user_permissions'));
    }

    public function adminAssignUserRolePermissionPost(Request $request, $user_id)
    {
        $data = $request->all(); //permission_ids
        //$data['permissions'];
        $user = User::find($user_id);
        
        foreach ($data['permission_ids'] as $key => $val) {
            if (!empty($val)) {
                $permission = Permission::find($data['permission_ids'][$key]);
                $user->givePermissionTo($permission);
            }
        }

        foreach ($data['role_ids'] as $key => $val) {
            if (!empty($val)) {
                $role = Role::find($data['role_ids'][$key]);
                $user->assignRole($role);
            }
        }
        return back(); 
    }

    public function adminRemoveUserRolePermission(Request $request, $user_id)
    {
        $data = $request->all(); //permission_ids
        $user = User::find($user_id);

        if (!empty($data['role_ids'])){
            foreach ($data['role_ids'] as $key => $val) {
                if (!empty($val)) {
                    $role = Role::find($data['role_ids'][$key]);
                    $permissions = $role->permissions;
                }
                //remove all possible user->perms
                foreach ($permissions as $perm) {
                    $user->revokePermissionTo($perm);
                }
                //remove user role
                $user->removeRole($role);
            }
        } else {
            
            foreach ($data['permission_ids'] as $key => $val) {
                if (!empty($val)) {
                    $permission = Permission::find($data['permission_ids'][$key]);
                    $user->revokePermissionTo($permission);
                }
            }
        }

        return back();
        
    }
}
