<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        return view('pages.users.index');
    }

    public function datatables()
    {
        $items = User::orderBy('id', 'desc');
        return Datatables::of($items)
            ->addIndexColumn()
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('d-M-y');
            })->make(true);
    }

    public function create()
    {
        return view('pages.users.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
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

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => "The user has been successfully registered",
        ]);
    }


    public function show(Request $request, $id)
    {
        $showOnly = $request->input('show', 0);
        $user = User::find($id);

        return view('pages.users.create', compact('user', 'showOnly'));
    }


//    public function update(Request $request, Category $category)
//    {
//        try {
//            $validator = Validator::make($request->all(), [
//                'name' => 'required',
//                'name_ar' => 'required',
//                'status' => 'required|in:0,1',
//                'description' => 'required',
//                'description_ar' => 'required',
//                'pic' => 'sometimes|max:3072|image'
//            ]);
//
//            if ($validator->fails()) {
//                return response()->json([
//                    'status' => 'error',
//                    'message' => $validator->errors()->first(),
//                ], 422);
//            }
//
//
//            $category->name = $request->name;
//            $category->name_ar = $request->name_ar;
//            $category->description = $request->description;
//            $category->description_ar = $request->description_ar;
//            $category->status = $request->status;
//
//            if ($request->hasFile('pic')) {
//                $image = $request->file('pic');
//                $imageName = time() . '.' . $image->extension();
//                $request->pic->storeAs('public/categories', $imageName);
//                $category->image = $imageName;
//            }
//
//            $category->save();
//
//            return response()->json([
//                'status' => 'success',
//                'message' => "The category information has been modified successfully",
//            ]);
//        } catch (ValidationException $e) {
//            return response()->json([
//                'status' => 'error',
//                'message' => $e->validator->errors()->first()
//            ], 400);
//        } catch (\Exception $e) {
//            return response()->json([
//                'status' => 'error',
//                'message' => 'An error occurred, please try again later'
//            ], 400);
//        }
//    }


//    public function destroy(Request $request, Category $category)
//    {
//        $categoryName = $category->name;
//        try {
//            $category->delete();
//            return response()->json([
//                'status' => 'success',
//                'message' => 'The ' . $categoryName . ' has been successfully deleted'
//            ], 200);
//        } catch (ValidationException $e) {
//            return response()->json([
//                'status' => 'error',
//                'message' => $e->getMessage()
//            ], 400);
//        }
//    }
}

