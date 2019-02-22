<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Resort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $resorts = Resort::all();
        $categories = Category::all();
        $category_resort = [];
        $category_tourist = [];
        foreach ($categories as $key => $category) {
            $resort = DB::select('
                SELECT 
                  cr.`category_id` 
                FROM
                  category_resort cr 
                  LEFT JOIN resorts r 
                    ON r.`id` = cr.`resort_id` 
                WHERE r.`deleted_at` IS NULL 
                  AND cr.`category_id` = '.$category->id.'
            ');

            $tourist = DB::select('
                SELECT 
                  ct.`category_id` 
                FROM
                  category_tourist ct 
                  LEFT JOIN tourists t 
                    ON t.`id` = ct.`tourist_id` 
                WHERE t.`deleted_at` IS NULL 
                  AND ct.`category_id` = '.$category->id.'
            ');

            array_push($category_resort, count($resort));
            array_push($category_tourist, count($tourist));
        }

        $pending = Resort::query()
            ->where('is_approve','=',0)
            ->get();

        $approve = Resort::query()
            ->where('is_approve','=',1)
            ->get();

        return view('admin.dashboard',[
            'resorts' => $resorts,
            'categories' => $categories,
            'category_resort' => $category_resort,
            'category_tourist' => $category_tourist,
            'pending' => $pending,
            'approved' => $approve,
        ]);
    }
}
