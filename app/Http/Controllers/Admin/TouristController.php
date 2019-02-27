<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Tourist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TouristController extends Controller
{

    public function index()
    {
        $data = Tourist::query()
            ->latest('updated_at')
            ->get();
        return view('admin.tourist.index',[
            'tourists' => $data
        ]);
    }

    public function create()
    {
        $data = Category::all();
        return view('admin.tourist.create',[
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'categories' => 'required',
            'description' => 'required',
        ]);

        $tourist = new Tourist();
        $tourist->name = $request->name;
        $tourist->slug = str_slug($request->title);
        $tourist->address = $request->address;
        $tourist->description = $request->description;
        $tourist->save();

        $tourist->categories()->attach($request->categories);

        Toastr::success('Successfully Saved' ,'Success');
        return redirect()->route('admin.tourist.index');
    }

    public function show(Tourist $tourist)
    {
        return view('admin.tourist.show',[
            'data' => $tourist
        ]);
    }

    public function edit(Tourist $tourist)
    {
        $categories = Category::all();
        return view('admin.tourist.edit',[
            'tourist' => $tourist,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Tourist $tourist)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'categories' => 'required',
            'description' => 'required',
        ]);

        $tourist->name = $request->name;
        $tourist->slug = str_slug($request->title);
        $tourist->address = $request->address;
        $tourist->description = $request->description;
        $tourist->save();

        $tourist->categories()->sync($request->categories);

        Toastr::success('Successfully Updated' ,'Success');
        return redirect()->route('admin.tourist.index');
    }

    public function destroy(Tourist $tourist)
    {
        Tourist::destroy($tourist->id);
        Toastr::success('Successfully Deleted' ,'Success');
        return redirect()->route('admin.tourist.index');
    }
}
