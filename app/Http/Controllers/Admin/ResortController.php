<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Resort;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ResortController extends Controller
{

    public function index()
    {
        $resorts = Resort::latest()->get();
        return view('admin.resort.index',[
            'resorts' => $resorts
        ]);
    }

    public function show(Resort $resort)
    {
        $categories = DB::select(
            '
            SELECT 
              c.* 
            FROM
              category_resort cr 
              LEFT JOIN resorts r 
                ON r.`id` = cr.`resort_id` 
              LEFT JOIN categories c 
                ON c.`id` = cr.`category_id` 
            WHERE r.`id` = '.$resort->id.'
            ORDER BY cr.updated_at 
        ');

        $entrances = DB::select(
            '
            SELECT 
              e.* 
            FROM
              entrances e 
              LEFT JOIN resorts r 
                ON r.id = e.`resort_id` 
            WHERE e.`resort_id` = '.$resort->id.'
            ORDER BY e.`updated_at` 
        ');

        $cottages = DB::select(
            '
            SELECT 
              c.* 
            FROM
              cottages c 
              LEFT JOIN resorts r 
                ON r.id = c.`resort_id` 
            WHERE c.`resort_id` = '.$resort->id.'
            ORDER BY c.`updated_at` 
        ');

        $packages = DB::select(
            '
            SELECT 
              p.* 
            FROM
              packages p 
              LEFT JOIN resorts r 
                ON r.id = p.`resort_id` 
            WHERE p.`resort_id` = '.$resort->id.'
            ORDER BY p.`updated_at` 
        ');

        $amenities = DB::select(
            '
            SELECT 
              a.* 
            FROM
              amenities a 
              LEFT JOIN resorts r 
                ON r.id = a.`resort_id` 
            WHERE a.`resort_id` = '.$resort->id.'
            ORDER BY a.`updated_at` 
        ');


        return view('admin.resort.show',[
            'resort' => $resort,
            'categories' => $categories,
            'entrances' => $entrances,
            'cottages' => $cottages,
            'packages' => $packages,
            'amenities' => $amenities,
        ]);
    }

    public function destroy(Resort $resort)
    {
        Resort::destroy($resort->id);
        Toastr::success('Successfully Deleted' ,'Success');
        return redirect()->route('admin.event.index');
    }
}
