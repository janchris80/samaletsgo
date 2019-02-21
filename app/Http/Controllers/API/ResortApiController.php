<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Package;
use App\Model\Resort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResortApiController extends Controller
{

    public function index()
    {
        $data = [];
        $resorts = Resort::all();
        foreach ($resorts as $resort) {
            $category = DB::select('
                SELECT 
                  c.name
                FROM
                  category_resort cr 
                  LEFT JOIN categories c 
                    ON c.`id` = cr.`category_id` 
                  LEFT JOIN resorts r 
                    ON r.`id` = cr.`resort_id` 
                WHERE r.`id` = ' . $resort->id . '
                  AND r.`deleted_at` IS NULL 
                GROUP BY cr.`category_id` 
                ORDER BY r.`updated_at`
            ');

            $package = DB::select('
                    SELECT 
                      * 
                    FROM
                      packages 
                    WHERE resort_id = ' . $resort->id . '
            ');

            $entrance = DB::select('
                SELECT 
                  * 
                FROM
                  entrances 
                WHERE resort_id = ' . $resort->id . '
            ');

            $cottage = DB::select('
                SELECT 
                  * 
                FROM
                  cottages 
                WHERE resort_id = ' . $resort->id . '
            ');

            $amenity = DB::select('
                SELECT 
                  * 
                FROM
                  amenities 
                WHERE resort_id = ' . $resort->id . '
            ');

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];

            foreach ($category as $key => $c) {
                $categories[$key] = $c->name;
            }

            foreach ($package as $key => $p) {
                $packages[$key]['name'] = $p->name;
                $packages[$key]['description'] = $p->description;
                $packages[$key]['rate'] = $p->rate;
                $packages[$key]['person'] = $p->person;
            }

            foreach ($entrance as $key => $e) {
                $entrances[$key]['agetype'] = $e->agetype;
                $entrances[$key]['tour'] = $e->tour;
                $entrances[$key]['description'] = $e->description;
                $entrances[$key]['rate'] = $e->rate;
                $entrances[$key]['person'] = $e->person;
            }

            foreach ($cottage as $key => $e) {
                $cottages[$key]['name'] = $e->name;
                $cottages[$key]['description'] = $e->description;
                $cottages[$key]['rate'] = $e->rate;
                $cottages[$key]['person'] = $e->person;
            }

            foreach ($amenity as $key => $e) {
                $amenities[$key]['name'] = $e->name;
                $amenities[$key]['description'] = $e->description;
                $amenities[$key]['rate'] = $e->rate;
            }


            $result = [
                'id' => $resort->id,
                'name' => $resort->name,
                'address' => $resort->address,
                'description' => $resort->description,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
            ];

            array_push($data, $result);
        }

        return $data;
    }

    public function like(Request $request)
    {
        $like = DB::select('
            SELECT 
              * 
            FROM
              likes 
            WHERE resort_id = ' . $request->id . '
        ');

        return $like;
    }

    public function likeUpdate(Request $request)
    {
        return $request->all();
    }

    public function package(Request $request)
    {
        $cat = '';
        $data = [];
        // beach pool resort

        if ($request->category === 'Resort') {
            $cat = "
            c.`name` = 'Pool' 
            OR c.`name` = 'Beach'
            ";
        } else {
            $cat = "c.`name` = '$request->category'";
        }

        $sql = DB::select('
            SELECT
              r.`id` AS resort_id,
              r.`name` AS resort_name,
              r.`address` AS resort_address,
              r.`description` AS resort_description,
              c.`id` AS category_id,
              c.`name` AS category_name,
              p.`id` AS package_id,
              p.`name` AS package_name,
              p.`description` AS package_description,
              p.`person` AS package_person,
              p.`rate` AS package_rate 
            FROM
              category_resort cr
              INNER JOIN categories c
                ON c.`id` = cr.`category_id`
              INNER JOIN resorts r
                ON r.`id` = cr.`resort_id`
              INNER JOIN packages p
                ON p.`resort_id` = r.`id`
            WHERE (
                ' . $cat . '
              )
              AND p.`rate` <= ' . $request->budget . '
              AND r.`deleted_at` IS NULL
            ');

        foreach ($sql as $index => $resort) {
            $category = DB::select('
                SELECT 
                  c.name
                FROM
                  category_resort cr 
                  LEFT JOIN categories c 
                    ON c.`id` = cr.`category_id` 
                  LEFT JOIN resorts r 
                    ON r.`id` = cr.`resort_id` 
                WHERE r.`id` = ' . $resort->resort_id . '
                  AND r.`deleted_at` IS NULL 
                GROUP BY cr.`category_id` 
                ORDER BY r.`updated_at`
            ');

            $package = DB::select('
                SELECT 
                  * 
                FROM
                  packages 
                WHERE resort_id = ' . $resort->resort_id . '
            ');

            $entrance = DB::select('
                SELECT 
                  * 
                FROM
                  entrances 
                WHERE resort_id = ' . $resort->resort_id . '
            ');

            $cottage = DB::select('
                SELECT 
                  * 
                FROM
                  cottages 
                WHERE resort_id = ' . $resort->resort_id . '
            ');

            $amenity = DB::select('
                SELECT 
                  * 
                FROM
                  amenities 
                WHERE resort_id = ' . $resort->resort_id . '
            ');

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];

            foreach ($category as $key => $c) {
                $categories[$key] = $c->name;
            }

            foreach ($package as $key => $p) {
                $packages[$key]['name'] = $p->name;
                $packages[$key]['description'] = $p->description;
                $packages[$key]['rate'] = $p->rate;
                $packages[$key]['person'] = $p->person;
            }

            foreach ($entrance as $key => $e) {
                $entrances[$key]['agetype'] = $e->agetype;
                $entrances[$key]['tour'] = $e->tour;
                $entrances[$key]['description'] = $e->description;
                $entrances[$key]['rate'] = $e->rate;
                $entrances[$key]['person'] = $e->person;
            }

            foreach ($cottage as $key => $e) {
                $cottages[$key]['name'] = $e->name;
                $cottages[$key]['description'] = $e->description;
                $cottages[$key]['rate'] = $e->rate;
                $cottages[$key]['person'] = $e->person;
            }

            foreach ($amenity as $key => $e) {
                $amenities[$key]['name'] = $e->name;
                $amenities[$key]['description'] = $e->description;
                $amenities[$key]['rate'] = $e->rate;
            }


            $result = [
                'id' => $resort->resort_id,
                'name' => $resort->resort_name,
                'address' => $resort->resort_address,
                'description' => $resort->resort_description,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
            ];

            array_push($data, $result);
        }
        $result_data = [
            'result' => $sql,
            'data' => $data
        ];

        return $result_data;
    }

    public function custom(Request $request)
    {
        $appendTour = "";
        $appendAgetype = "";
        $totalEntrance = 0;
        $minCottage = 0;
        $total = 0;
        $result = 0;
        $selectedResort = array();

        if ($request->day AND !$request->night) {
            $appendTour = "WHERE entrances.tour  = 'Daytour and Overnight' OR entrances.tour  = 'Daytour'";
            $appendAgetype = "WHERE entrances.tour = 'Daytour'";
        } else if (!$request->day AND $request->night) {
            $appendTour = "WHERE entrances.tour  = 'Daytour and Overnight' OR entrances.tour  = 'Overnight'";
            $appendAgetype = "WHERE entrances.tour = 'Overnight'";
        } else {
            $appendTour = "WHERE entrances.tour  = 'Daytour and Overnight' OR entrances.tour  = 'Overnight' OR entrances.tour  = 'Daytour'";
            $appendAgetype = "WHERE entrances.tour = 'Daytour and Overnight'";
        }

        $resorts = DB::select("SELECT *,resorts.id AS resort_id FROM resorts
                                    LEFT JOIN entrances
                                    ON entrances.resort_id = resorts.id
                                    LEFT JOIN category_resort
                                    ON resorts.id = category_resort.resort_id
                                    LEFT JOIN categories
                                    ON categories.id = category_resort.category_id
                                    $appendTour 
                                    GROUP BY resorts.name  ");

        foreach ($resorts as $resort) {

            $id = $resort->resort_id;
            $selectResortEntrance = DB::select("SELECT * FROM entrances $appendAgetype AND resort_id  = $id");

            foreach ($selectResortEntrance as $entrance) {
                if ($entrance->agetype == 'Kid'){
                    $totalEntrance = $totalEntrance + ($entrance->rate *$request->kid);
                }else if ($entrance->agetype == 'Adult'){
                    $totalEntrance = $totalEntrance + ($entrance->rate *$request->adult);
                }else{
                    $totalEntrance = $totalEntrance + ($entrance->rate *$request->adult);
                }

            }

//  select the minimum rate of cottage per resort here, kamsa - love kaye :)
            $selectMinCottageRatePerResort = DB::select("
                    SELECT *,count(*) as count FROM cottages 
                    WHERE resort_id = $id 
                    ORDER BY rate LIMIT 1");


            foreach ($selectMinCottageRatePerResort as $cottage) {
                if ($cottage->count > 0) {
                    $minCottage = $minCottage + $cottage->rate;
                }
            }

            $total = $totalEntrance + $minCottage;
            $result = $request->budget - $total;

            if ($result >= 0 AND $result <= $request->budget) {
                array_push($selectedResort, $resort->resort_id);
            }


            $totalEntrance = 0;
            $minCottage = 0;
            $total = 0;
            $result = 0;

        }
        // array that will hold search result and resort data
        $data = [];

        $finalSelected = DB::table('resorts')->whereIn('id', $selectedResort)->get();

        foreach ($finalSelected as $index => $resort) {
            $category = DB::select('
                SELECT 
                  c.name
                FROM
                  category_resort cr 
                  LEFT JOIN categories c 
                    ON c.`id` = cr.`category_id` 
                  LEFT JOIN resorts r 
                    ON r.`id` = cr.`resort_id` 
                WHERE r.`id` = ' . $resort->id . '
                  AND r.`deleted_at` IS NULL 
                GROUP BY cr.`category_id` 
                ORDER BY r.`updated_at`
            ');

            $package = DB::select('
                    SELECT 
                      * 
                    FROM
                      packages 
                    WHERE resort_id = ' . $resort->id . '
            ');

            $entrance = DB::select('
                SELECT 
                  * 
                FROM
                  entrances 
                WHERE resort_id = ' . $resort->id . '
            ');

            $cottage = DB::select('
                SELECT 
                  * 
                FROM
                  cottages 
                WHERE resort_id = ' . $resort->id . '
            ');

            $amenity = DB::select('
                SELECT 
                  * 
                FROM
                  amenities 
                WHERE resort_id = ' . $resort->id . '
            ');

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];

            foreach ($category as $key => $c) {
                $categories[$key] = $c->name;
            }

            foreach ($package as $key => $p) {
                $packages[$key]['name'] = $p->name;
                $packages[$key]['description'] = $p->description;
                $packages[$key]['rate'] = $p->rate;
                $packages[$key]['person'] = $p->person;
            }

            foreach ($entrance as $key => $e) {
                $entrances[$key]['agetype'] = $e->agetype;
                $entrances[$key]['tour'] = $e->tour;
                $entrances[$key]['description'] = $e->description;
                $entrances[$key]['rate'] = $e->rate;
                $entrances[$key]['person'] = $e->person;
            }

            foreach ($cottage as $key => $e) {
                $cottages[$key]['name'] = $e->name;
                $cottages[$key]['description'] = $e->description;
                $cottages[$key]['rate'] = $e->rate;
                $cottages[$key]['person'] = $e->person;
            }

            foreach ($amenity as $key => $e) {
                $amenities[$key]['name'] = $e->name;
                $amenities[$key]['description'] = $e->description;
                $amenities[$key]['rate'] = $e->rate;
            }


            $result = [
                'id' => $resort->id,
                'name' => $resort->name,
                'address' => $resort->address,
                'description' => $resort->description,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
            ];

            array_push($data, $result);
        }

        $test = [
            'data' => $data,
            'result' => $finalSelected
        ];

        return $test;

    }

    public function trending()
    {
        $likes = [];
        foreach (Resort::all() as $resort) {
            $res = DB::table('likes')
                ->leftJoin('resorts','resorts.id','=','likes.resort_id')
                ->where('resorts.id','=',$resort->id)
                ->count();
            array_push($likes, $res);
        }

        $resorts = DB::table('likes')
            ->leftJoin('resorts','resorts.id','=','likes.resort_id')
            ->groupBy('resorts.id')
            ->get();

        $data = [
            'resort' => $resorts,
            'likes' => $likes
        ];

        return $data;
    }
}
