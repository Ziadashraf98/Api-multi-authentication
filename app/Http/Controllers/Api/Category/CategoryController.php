<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id' , 'name_' . app()->getLocale() . ' as name')->get();
        return response()->json(['success'=>true , 'data'=>$categories]);
    }

    public function single_category($id)
    {
        $category = Category::select('id' , 'name_' . app()->getLocale() . ' as name')->find($id);
        
        if(!$category) return response()->json(['success'=>false , 'data'=>'Category Not Found']);
        
        return response()->json(['success'=>true , 'data'=>$category]);
    }

    public function store(CategoryRequest $request)
    {
        $validation = $request->validated();
        $category = Category::create($validation);
        return response()->json(['success'=>true , 'data'=>$category]);
    }
}