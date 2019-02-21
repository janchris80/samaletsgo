<?php

namespace App\Http\Controllers\Owner;

use App\Model\Resort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $resorts = Resort::all();

        $beach = DB::select('
            SELECT 
              cr.resort_id 
            FROM
              category_resort cr 
              INNER JOIN resorts r 
                ON r.`id` = cr.`resort_id` 
            WHERE r.`deleted_at` IS NULL 
            GROUP BY cr.resort_id 
        ');

        return view('owner.dashboard',[
            'resorts' => $resorts,
            'beach' => $beach
        ]);
    }
}
