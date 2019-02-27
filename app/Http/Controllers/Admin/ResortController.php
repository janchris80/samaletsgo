<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Resort;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ResortController extends Controller
{

    public function index()
    {
        $resorts = Resort::query()
            ->latest('updated_at')
            ->get();
        return view('admin.resort.index',[
            'resorts' => $resorts
        ]);
    }

    public function show(Resort $resort)
    {
        $categories = DB::table('category_resort')
            ->where('category_resort.resort_id','=', $resort->id)
            ->leftJoin('categories','categories.id','category_resort.category_id')
            ->get();

        $entrances = DB::table('entrances')
            ->where('resort_id','=', $resort->id)
            ->get();

        $cottages = DB::table('cottages')
            ->where('resort_id','=', $resort->id)
            ->get();

        $packages = DB::table('packages')
            ->where('resort_id','=', $resort->id)
            ->get();

        $amenities = DB::table('amenities')
            ->where('resort_id','=', $resort->id)
            ->get();

        $images = DB::table('images')
            ->where('resort_id','=', $resort->id)
            ->get();

        return view('admin.resort.show',[
            'resort' => $resort,
            'categories' => $categories,
            'entrances' => $entrances,
            'cottages' => $cottages,
            'packages' => $packages,
            'amenities' => $amenities,
            'images' => $images,
        ]);
    }

    public function update(Request $request, Resort $resort)
    {
        $resort->is_approve = 1;
        $resort->approve_by = Auth::user()->id;
        $resort->save();

        return back();
    }

    public function destroy(Resort $resort)
    {
        Resort::destroy($resort->id);
        Toastr::success('Successfully Deleted' ,'Success');
        return redirect()->route('admin.event.index');
    }
}
