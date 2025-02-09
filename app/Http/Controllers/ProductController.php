<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function store(Request $request) {

        $this->checkAdmin($request);
        $request->validate([
            'name' => 'required|string|unique:products',
            'price' => 'required|numeric|min:0',
            'category_ids' => 'required|array',
            'category_ids.*' => 'uuid|exists:categories,id'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        $product->categories()->attach($request->category_ids);

        return response()->json($product->load('categories'), 201);
    }

    public function index(Request $request) {
        $perPage = (int) $request->query('per_page', 1);
        $page = (int) $request->query('page', 1);

        $products = Product::with('categories')->paginate($perPage, ['*'], 'page', $page);

        // return response()->json($products);
        return response()->json([
            'current_page' => $products->currentPage(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
            'last_page' => $products->lastPage(),
            'data' => $products->items(),
        ]);
    }

    public function show($id) {
        $product = Product::with('categories')->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id) {
        $this->checkAdmin($request);


        $request->validate([
            'name' => 'sometimes|string|unique:products,name,' . $id,
            'price' => 'sometimes|numeric|min:0',
            'category_ids' => 'sometimes|array',
            'category_ids.*' => 'uuid|exists:categories,id'
        ]);

        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found.');
        }

        $product->update($request->only(['name', 'price']));

        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        return response()->json($product->load('categories'));
    }

    public function destroy($id) {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found.');
        }

        $product->categories()->detach();
        $product->delete();

        return response()->json(['message' => 'Producto eliminado'], 200);
    }
}
