<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class AudioController extends Controller
{
    public function index()
    {
        return view('pages.audio.index');
    }

    public function datatables()
    {
        $items = Audio::
        leftJoin('categories','categories.id','audios.category_id')
        ->select('audios.*','categories.name as categoryName');
        return Datatables::of($items)
            ->addIndexColumn()
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('d-M-y');
            })->make(true);
    }

    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        return view('pages.audio.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'title_ar' => 'required',
            'status' => 'required|in:0,1',
            'description' => 'required',
            'description_ar' => 'required',
            'audio' => 'required|max:10024|mimes:audio/mpeg,mpga,mp3,wav'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $Audio = new Audio();

        $Audio->title = $request->title;
        $Audio->title_ar = $request->title_ar;
        $Audio->description = $request->description;
        $Audio->description_ar = $request->description_ar;
        $Audio->status = $request->status;
        $Audio->category_id = $request->category_id;


        if ($request->hasFile('audio')) {
            $audioFile = $request->file('audio');
            $audioName = time() . '.' . $audioFile->extension();
            $request->audio->storeAs('public/audios', $audioName);
            $Audio->path = $audioName;
        }

        $Audio->save();

        return response()->json([
            'status' => 'success',
            'message' => "The Audio has been successfully added",
        ]);
    }


    public function show(Request $request, $id)
    {
        $showOnly = $request->input('show', 0);
        $item = Audio::find($id);
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        return view('pages.audio.create', compact(['item', 'showOnly', 'categories']));
    }


    public function update(Request $request, Audio $audio)
    {
        try {

            $validator = Validator::make($request->all(), [
                'category_id' => 'required|exists:categories,id',
                'title' => 'required',
                'title_ar' => 'required',
                'status' => 'required|in:0,1',
                'description' => 'required',
                'description_ar' => 'required',
                'audio' => 'sometimes|max:10024|mimes:audio/mpeg,mpga,mp3,wav'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 422);
            }


            $audio->title = $request->title;
            $audio->title_ar = $request->title_ar;
            $audio->description = $request->description;
            $audio->description_ar = $request->description_ar;
            $audio->status = $request->status;
            $audio->category_id = $request->category_id;


            if ($request->hasFile('audio')) {
                $audioFile = $request->file('audio');
                $audioName = time() . '.' . $audioFile->extension();
                $request->audio->storeAs('public/audios', $audioName);
                $audio->path = $audioName;
            }

            $audio->save();

            return response()->json([
                'status' => 'success',
                'message' => "The Audio information has been modified successfully",
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


    public function destroy(Request $request, Audio $audio)
    {
        $audioName = $audio->title;
        try {
            $audio->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The ' . $audioName . ' has been successfully deleted'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
