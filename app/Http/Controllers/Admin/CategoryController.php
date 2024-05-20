<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view ("admin.category.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:30|unique:categories',
            'image' => 'required'
        ]);

        try{
            $category = new Category;
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['name']);

            $file = $request->file("image");
            $filename = time().".".$file->getClientOriginalExtension();
            $file->move("uploads/categories/", $filename);
            $category->image = $filename;

            $category->save();

            return redirect('admin/categories')->with("success", "Category created");
        }
        catch(Exception $error){
            return redirect('admin/categories')->with("error", "Category cannot be created");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "Show called";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "Destroy called";
    }
}
