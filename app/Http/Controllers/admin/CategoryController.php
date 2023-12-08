<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.category.index');
    }

    public function datatables()
    {
        $items = Category::orderBy('id','desc');
        return Datatables::of($items)
            ->addIndexColumn()
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('d-M-y');
            })->make(true);
    }

    public function create()
    {
        return view('pages.category.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_ar' => 'required',
            'status' => 'required|in:0,1',
            'description' => 'required',
            'description_ar' => 'required',
            'pic'=>'required|max:3072|image'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $Category=new Category();

        $Category->name = $request->name;
        $Category->name_ar = $request->name_ar;
        $Category->description = $request->description;
        $Category->description_ar = $request->description_ar;
        $Category->status = $request->status;


        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $imageName = time().'.'.$image->extension();
            $request->pic->storeAs('public/categories', $imageName);
            $Category->image=$imageName;
        }

        $Category->save();

        return response()->json([
            'status' => 'success',
            'message' => "The category has been successfully added",
        ]);
    }


    public function show(Request $request,$id)
    {
        $showOnly=$request->input('show',0);
        $item = Category::find($id);
        return view('pages.category.create', compact(['item','showOnly']));
    }


    public function update(Request $request, Category $category)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'name_ar' => 'required',
                'status' => 'required|in:0,1',
                'description' => 'required',
                'description_ar' => 'required',
                'pic'=>'sometimes|max:3072|image'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 422);
            }


            $category->name = $request->name;
            $category->name_ar = $request->name_ar;
            $category->description = $request->description;
            $category->description_ar = $request->description_ar;
            $category->status = $request->status;

            if ($request->hasFile('pic')) {
                $image = $request->file('pic');
                $imageName = time().'.'.$image->extension();
                $request->pic->storeAs('public/categories', $imageName);
                $category->image=$imageName;
            }

            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => "The category information has been modified successfully",
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


    public function destroy(Request $request, Category $Category)
    {
        $categoryName= $Category->name;
        try {
            $Category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The '.$categoryName.' has been successfully deleted'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
