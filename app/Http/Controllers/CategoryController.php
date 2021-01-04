<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }


    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }


    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return response(new CategoryResource($category), Response::HTTP_OK);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
