<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.category');
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
//        return view('sight-sense.category-issue.create');
    }


    public function store(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'category_issue_name' => 'required',
//            'description' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => 'error',
//                'message' => $validator->errors()->first(),
//            ], 422);
//        }
//
//        CategoryIssue::create([
//            'name' => $request->category_issue_name,
//            'description' => $request->description,
//            'created_by' => Auth::user()->id
//        ]);
//
//        return response()->json([
//            'status' => 'success',
//            'message' => "The category Issues has been successfully added",
//        ]);
    }


    public function show($id)
    {
//        $item = CategoryIssue::find($id);
//        $pluralTitle = self::PLURAL_TITLE;
//        $title = self::SINGULAR_TITLE;
//        $lowerTitle = self::SINGULAR_LOWER_TITLE;
//
//        return view('sight-sense.category-issue.create', compact(['item', 'title', 'pluralTitle', 'lowerTitle']));
    }




    public function update(Request $request, Category $category)
    {
//        try {
//            $id = $request->id;
//            $category_issue = CategoryIssue::find($id);
//            $category_issue->update([
//                'name' => $request->category_issue_name,
//                'description' => $request->description,
//            ]);
//
//            return response()->json([
//                'status' => 'success',
//                'message' => "The category issues information has been modified successfully",
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
    }


    public function destroy(Request $request, Category $category)
    {
        $category=$category->name;
        try {
            $category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The '.$category.' has been successfully deleted'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
