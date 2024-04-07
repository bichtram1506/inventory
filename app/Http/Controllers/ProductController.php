<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách các sản phẩm.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        return view('page.product.index', ['products' => $products]);
    }

    /**
     * Hiển thị form tạo sản phẩm mới.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Lưu một sản phẩm mới.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Define other validation rules here
        ]);

        // Create new product
        $product = Product::create($request->all());

        // Redirect to the product's show page
        return redirect()->route('products.show', $product->id);
    }

    /**
     * Hiển thị thông tin một sản phẩm cụ thể.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Hiển thị form để chỉnh sửa một sản phẩm.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Cập nhật thông tin một sản phẩm.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Define other validation rules here
        ]);

        // Find the product
        $product = Product::findOrFail($id);

        // Update the product
        $product->update($request->all());

        // Redirect to the product's show page
        return redirect()->route('products.show', $product->id);
    }

    /**
     * Xóa một sản phẩm.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect back to the index page
        return redirect()->route('products.index');
    }
}
