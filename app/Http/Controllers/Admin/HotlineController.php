<?php

namespace App\Http\Controllers\Admin;

use App\Model\Hotline;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotlineController extends Controller
{

    public function index()
    {
        $hotlines = Hotline::query()
            ->latest()
            ->get();
        return view('admin.hotline.index', [
            'hotlines' => $hotlines
        ]);
    }

    public function create()
    {
        return view('admin.hotline.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'number' => 'required',
        ]);

        $hotline = new Hotline();
        $hotline->name = $request->name;
        $hotline->number = $request->number;
        $hotline->save();

        Toastr::success('Successfully Saved' ,'Success');
        return redirect()->route('admin.hotline.index');
    }

    public function edit(Hotline $hotline)
    {
        return view('admin.hotline.edit',[
            'hotline' => $hotline
        ]);
    }

    public function update(Request $request, Hotline $hotline)
    {
        $this->validate($request, [
            'name' => 'required',
            'number' => 'required',
        ]);

        $hotline->name = $request->name;
        $hotline->number = $request->number;
        $hotline->save();

        Toastr::success('Successfully Updated' ,'Success');
        return redirect()->route('admin.hotline.index');
    }

    public function destroy(Hotline $hotline)
    {
        $hotline::destroy($hotline->id);
        Toastr::success('Successfully Deleted' ,'Success');
        return redirect()->route('admin.hotline.index');
    }
}
