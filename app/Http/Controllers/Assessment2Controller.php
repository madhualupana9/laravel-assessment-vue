<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class Assessment2Controller extends Controller
{
    public function index()
    {
        return view('layouts.app');
    }

    public function indexApi()
    {
        $categories = Category::with('parent')->get();
        return response()->json($categories);
    }

    public function showApi(Category $category)
    {
        $category->load('parent');
        return response()->json($category);
    }

    public function create()
    {
        return view('layouts.app');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:1,2',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($validated);
        return redirect()->route('assessment2.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('layouts.app');
    }

    public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'status' => 'required|in:1,2',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    $category->update($validated);

    // Handle both API and web responses
    if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    return redirect()->route('assessment2.index')->with('success', 'Category updated successfully');
}


public function destroy(Request $request, Category $category)
{
    $category->delete();

    if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
            'data' => $category
        ]);
    }

    return redirect()->route('assessment2.index')->with('success', 'Category deleted successfully');
}

}
