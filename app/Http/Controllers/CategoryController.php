<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCateList(){
        
        return view('admin.cate_list');
    }
    // Phương thức thêm mới category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    // Phương thức cập nhật category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    // Phương thức xóa category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
