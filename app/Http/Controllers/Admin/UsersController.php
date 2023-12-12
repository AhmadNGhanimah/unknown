<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        return view('pages.users.index');
    }

    public function datatables()
    {
        $items = User::with('roles');
        return Datatables::of($items)
            ->addIndexColumn()
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('d-M-y');
            })->make(true);
    }

    public function create()
    {
        $roles = Role::get();
        return view('pages.users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
            'role_id' => 'required_if:is_admin,1'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->has('is_admin') ? 1 : 0;

        $user->save();

        if ($user->is_admin)
        $user->assignRole($request->input('role_id'));


        return response()->json([
            'status' => 'success',
            'message' => "The user has been successfully registered",
        ]);
    }


    public function show(Request $request, $id)
    {
        $showOnly = $request->input('show', 0);
        $item = User::find($id);
        $roles = Role::get();

        return view('pages.users.create', compact('item', 'showOnly', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $request->id,
                'is_admin' => 'required|in:0,1',
                'role_id' => 'required_if:is_admin,1'

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 422);
            }


            $user->name = $request->name;
            $user->email = $request->email;
            $user->is_admin = $request->has('is_admin') ? 1 : 0;

            if (!empty($request->password))
                $user->password = bcrypt($request->password);


            $user->save();

            if ($user->is_admin)
            $user->assignRole($request->input('role_id'));


            return response()->json([
                'status' => 'success',
                'message' => "The User information has been modified successfully",
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->validator->errors()->first()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred, please try again later'
            ], 400);
        }
    }


    public function destroy(Request $request, User $user)
    {
        $UserName = $user->name;
        try {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The ' . $UserName . ' has been successfully deleted'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

