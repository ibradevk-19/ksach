<?php

namespace App\Http\Controllers\Admin\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use phpDocumentor\Reflection\Types\Parent_;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{

    public function index(Request $request)
    {



        if ($request->ajax()) {
            $data = Role::query()->select(['id', 'name', 'status'])->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'status' => $item->status,
                    'count_permission' => $item->permissions->count(),

                ];
            })->toArray();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.roles.datatables.action')
                ->addColumn('status_role', 'admin.roles.datatables.status_role')
                ->addColumn('count_permission', 'admin.roles.datatables.count_permission')
                ->rawColumns(['action', 'status_role', 'count_permission'])
                ->make(true);
        }


        return view('admin.roles.index');
    }


    public function create()
    {

        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    public function edit($id)
    {

        $obj = Role::find($id);

        $obj->load('permissions');
        $names = [];
        if ($obj) {

            foreach ($obj['permissions'] as $permission) {
                $names[] = $permission->name;
            }
        }
        $permissions = Permission::all();
        // dd($permissions);
        return view('admin.roles.edit', compact('obj', 'permissions', 'names'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'permissions' => 'required|min:1',

        ], [
            'name.required' => 'الإسم مطلوب',
            'permissions.required' => 'يجب على الأقل اختيار صلاحية واحدة',
            'permissions.min' => 'يجب على الأقل اختيار صلاحية واحدة',
        ]);
        parent::saveModel($request, Role::class);

        if ($request->id) return  redirect()->route('roles.index')->with("success", "تم التعديل بنجاح");


        return  redirect()->route('roles.index')->with("success", "تم الإنشاء بنجاح");
    }

    public function show($id){


         $obj = Role::find($id);
         $roles_all = Role::where('id','!=',$id)->get();

         return view('admin.roles.modal_del',compact(['roles_all','obj']));
    }


    public function delete_roles(Request $request)
    {
        $role_del =    Role::find($request->id);
        $admins = $role_del->users;
        if($request->role_id){





            foreach ($admins as $key => $item) {

                $item->roles()->detach();
                $item->assignRole($request->role_id);

            }

        }
        else {

            foreach ($admins as $key => $item) {

                $item->status = '0';
                $item->save();

            }

        }


        $role_del->delete();
        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح  '], 200);



        // return true;
    }
}
