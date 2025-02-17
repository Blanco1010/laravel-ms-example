<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller {

    public function index() {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return response()->json($categories);
    }

    public function show(Category $category) {
        return response()->json($category->load('children'));
    }

    public function store(Request $request) {
        $this->checkAdmin($request);
        $data = $request->validate([
            'name' => 'required|string|unique:categories',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($data);
        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category) {
        $this->checkAdmin($request);

        $data = $request->validate([
            'name' => ['string', Rule::unique('categories')->ignore($category->id)],
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($data);
        return response()->json($category);
    }

    public function destroy(Request $request, $id) {
        $this->checkAdmin($request);

        $category = Category::find($id);

        if (!$category) {
            abort(404, 'Category not found.');
        }

        $category->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function getProductsByCategory($categoryId, Request $request) {
        // $perPage = (int) $request->query('per_page', 10);
        // $page = (int) $request->query('page', 1);

        $products = Product::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->get();
        // ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($products);
    }
}
