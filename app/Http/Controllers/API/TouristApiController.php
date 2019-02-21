<?php

namespace App\Http\Controllers\API;

use App\Model\Tourist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TouristApiController extends Controller
{
    public function index()
    {
        $data = [];
        $tourists = Tourist::all();
        foreach ($tourists as $tourist) {
            $category = DB::select('
                SELECT 
                  c.name
                FROM
                  category_tourist ct 
                  LEFT JOIN categories c 
                    ON c.`id` = ct.`category_id` 
                  LEFT JOIN tourists t 
                    ON t.`id` = ct.`tourist_id` 
                WHERE t.`id` = '.$tourist->id.'
                  AND t.`deleted_at` IS NULL 
                GROUP BY ct.`category_id` 
                ORDER BY t.`updated_at`
            ');

            $categ = [];

            foreach ($category as $key => $cat) {
                $categ[$key] = $cat->name;
            }


            $result = [
                'id' => $tourist->id,
                'name' => $tourist->name,
                'address' => $tourist->address,
                'description' => $tourist->description,
                'category' => $categ,
            ];

            array_push($data, $result);
        }

        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
