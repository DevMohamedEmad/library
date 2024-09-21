<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    public function store(StoreCategoryRequest $request)
    {
        $inputs = $request->all();

        Category::create($inputs);

        return response()->json(['message' => 'Category created successfully', 'status' => 201]);
    }

    public function update(Request $request, $category)
    {
        $inputs = $request->all();

        $category = Category::find($category);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->update($inputs);

        return response()->json(['message' => 'Category updated successfully'],200);
    }

    public function destroy(Category $category)
    {

        $category = Category::whereId($category->id)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'],200);

    }
}
