<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách các danh mục.
     *
     * @return View
     */
    public function index(): View
    {
       
        $categories = DB::table('categories')->paginate(NUMBER_PAGINATION);
        return view('page.category.index', ['categories' => $categories]);
    }

    /**
     * Hiển thị biểu mẫu tạo mới một danh mục.
     *
     * @return View
     */
    public function create(): View
    {
        return view('page.category.create');
    }

    /**
     * Lưu danh mục mới vào cơ sở dữ liệu.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công.');
    }


    /**
     * Hiển thị thông tin chi tiết của một danh mục.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('page.category.show', ['category' => $category]);
    }

    /**
     * Hiển thị biểu mẫu chỉnh sửa một danh mục.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('page.category.edit', ['category' => $category]);
    }

    /**
     * Cập nhật thông tin của một danh mục trong cơ sở dữ liệu.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::table('categories')->where('id', $id)->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('categories.index')->with('success', 'Thông tin danh mục đã được cập nhật thành công.');
    }


    /**
     * Xóa một danh mục khỏi cơ sở dữ liệu.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
