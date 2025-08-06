<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest('id')->paginate(10);
        $guard = request()->route('guard');
        return view('roles.index', compact('roles', 'guard'));
      
      
    }

    public function create()
    {
        $permissions = Permission::select('id', 'name')->get();
        $guard = request()->route('guard');
        return view('roles.create', compact('permissions', 'guard'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'abilities' => 'array|nullable'
        ]);

        $name = $request->name;
        $guard = null;

        // ابحث في جداول المستخدمين
        if (\App\Models\Admin::where('name', $name)->exists()) {
            $guard = 'admin';
        } elseif (\App\Models\Freelancer::where('name', $name)->exists()) {
            $guard = 'freelancer';
        } elseif (\App\Models\User::where('name', $name)->exists()) {
            $guard = 'web';
        }

        // إذا لم يتم العثور عليه
        if (!$guard) {
            return back()->withErrors(['name' => 'This user does not exist in any guard.']);
        }

        // تأكد ألا يكون الدور مكررًا لنفس الـ guard
        if (Role::where('name', $name)->where('guard_name', $guard)->exists()) {
            return back()->withErrors(['name' => 'Role "' . $name . '" already exists for guard "' . $guard . '".']);
        }

        // إنشاء الدور
        $role = Role::create([
            'name' => $name,
            'guard_name' => $guard,
        ]);

        // ربط الصلاحيات إن وُجدت
        if ($request->filled('abilities')) {
            $role->permissions()->sync($request->abilities);
        }

        return redirect()->route( 'admin.roles.index')->with('success', "Role '$name' created with guard '$guard'");
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::select('id', 'name')->get();
        $guard = request()->route('guard');
        return view('roles.edit', compact('permissions', 'role', 'guard'));
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        // $role->syncPermissions($request->abilities);
        $permissions = Permission::whereIn('id', $request->abilities)
            ->where('guard_name', $role->guard_name) // تأكد أن الجارد متوافق
            ->pluck('name')
            ->toArray();

        $role->syncPermissions($permissions);



        return redirect()->route('admin.roles.index')->with([
            'msg' => 'Role updated successfully',
            'type' => 'success',
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        $guard = request()->route('guard');
        return redirect()->route( 'admin.roles.index')->with([
            'msg' => 'Role deleted successfully',
            'type' => 'danger',
        ]);
    }
}
