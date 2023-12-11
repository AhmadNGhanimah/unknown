<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;


class RoleController extends Controller
{

    public function index()
    {
        return view('pages.role.index');
    }

    public function datatables()
    {

        $priorities = Role::query();
        return Datatables::of($priorities)
            ->addIndexColumn()
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('d-M-y');
            })->make(true);
    }

    public function create()
    {

        $permissions = Permission::get();

        return view('pages.role.create', compact(['permissions']));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $role = Role::create([
            'name' => $request->input('name')
        ]);

        $role->syncPermissions($request->input('permissions'));

        return response()->json([
            'status' => 'success',
            'message' => "The Role has been successfully added",
        ]);

    }

    public function show($id)
    {
        $item = Role::find($id);
        $permissions = Permission::with('roles')->get();

        return view('pages.role.create', compact(['item','permissions']));
    }


    public function edit(Role $role)
    {
        //
    }

    public function update(Request $request, Role $role)
    {
        $id = $request->id;
        try {
            $request->validate([
                'name' => 'required|unique:roles,name,' . $id,
                'permissions' => 'required',
            ]);

            $role->update([
                'name' => $request->name
            ]);

            $role->syncPermissions($request->input('permissions'));

            return response()->json([
                'status' => 'success',
                'message' => 'The Role information has been modified successfully'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->validator->errors()->first()
            ], 400);
        }


    }

    public function destroy(Request $request, Role $role)
    {
        try {
            $role->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'The Role  has been successfully deleted'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
