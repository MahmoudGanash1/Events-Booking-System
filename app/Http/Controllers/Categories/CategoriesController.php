<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function showall()
    {
        $categories = Category::all();
        return response()->json($categories);
    }


    public function showone(Category $category)
    {
        return response()->json($category);

    }



    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        request()->validate([
            'title' => 'required|string',   
            'description' => 'nullable|string',

        ]);

        $category = Category::create($request->all());

        
        return response()->json(' Category Added Successfully', 200);
    }




    public function update(Request $request, Category $category)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        request()->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['title', 'description']));

        return response()->json(' Category Updated Successfully', 200);
    }



    public function destroy(Category $category)
    {

        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $category->delete();
         return response()->json(' Category Deleted Successfully', 200);
    }

   

}