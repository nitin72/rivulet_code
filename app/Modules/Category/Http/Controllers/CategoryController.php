<?php

namespace App\Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Category\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view("Category::list");
    }

    public function create() {
        return view('Category::create');
    }

    public function getCategories() {
        $data = Category::get();
        return response()->json(['data'=>$data, 200]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json(['msg'=>'Data error.'], 400);
        }
        Category::create(['title'=>$request->title]);
        return response()->json(['msg'=>'Data added successfully.'], 200);
    }
}
