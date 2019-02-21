<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',[
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category = new Category();
        $category->name = ucwords($request->name);
        $category->slug = str_slug($request->name);
        $category->save();

        Toastr::success('Successfully Added' ,'Success');
        return redirect()->route('admin.category.index');
    }

    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {

        return view('admin.category.edit',[
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();

        Toastr::success('Successfully Updated' ,'Success');
        return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        //
    }
}
