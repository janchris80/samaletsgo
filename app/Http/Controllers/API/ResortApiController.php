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

    public function index(Request $request)
    {
        $data = [];
        $resorts = Resort::query()
            ->where('is_approve','=',1)
            ->latest('updated_at')
            ->get();
        foreach ($resorts as $resort) {
            $category = DB::table('category_resort')
                ->where('category_resort.resort_id','=', $resort->id)
                ->join('categories','categories.id','=','category_resort.category_id')
                ->get();

            $package = DB::table('packages')
                ->where('resort_id','=', $resort->id)
                ->get();

            $entrance = DB::table('entrances')
                ->where('resort_id','=', $resort->id)
                ->get();

            $cottage = DB::table('cottages')
                ->where('resort_id','=', $resort->id)
                ->get();

            $amenity = DB::table('amenities')
                ->where('resort_id','=', $resort->id)
                ->get();

            $image = DB::table('images')
                ->where('resort_id','=', $resort->id)
                ->get();

            $frontpage = DB::table('images')
                ->where('resort_id','=', $resort->id)
                ->where('is_frontpage','=', 1)
                ->latest('updated_at')
                ->first();

            $like = DB::table('likes')
                ->where('resort_id','=', $resort->id)
                ->where('email','=', $request->email)
                ->count();

            $like_count = DB::table('likes')
                ->where('resort_id','=', $resort->id)
                ->count();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $likes = [];
            $images = [];

            foreach ($category as $key => $c) {
                $categories[$key]['name'] = $c->name;
            }

            foreach ($image as $key => $c) {
                $images[$key]['location'] = $c->file_location;
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
                'image' => $image,
                'frontpage' => $frontpage,
                'like' => $like,
                'like_count' => $like_count,
            ];

            array_push($data, $result);
        }

        return $data;
    }

    public function like(Request $request)
    {
        return $request->all();
    }

    public function package(Request $request)
    {
        $data = [];

        $sql = DB::table('resorts')
            ->where('categories.name','=', $request->category)
            ->where('packages.rate','<=', $request->budget)
            ->where('resorts.is_approve','=',1)
            ->where('resorts.deleted_at','=', NULL)
            ->join('category_resort','category_resort.resort_id','=','resorts.id')
            ->join('categories','categories.id','=','category_resort.category_id')
            ->join('packages','packages.resort_id','=','resorts.id')
            ->select(
                'resorts.id AS resort_id',
              'resorts.name AS resort_name',
              'resorts.address AS resort_address',
              'resorts.description AS resort_description',
              'categories.id AS category_id',
              'categories.name AS category_name',
              'packages.id AS package_id',
              'packages.name AS package_name',
              'packages.description AS package_description',
              'packages.person AS package_person',
              'packages.rate AS package_rate'
                )
            ->get();


        foreach ($sql as $index => $resort) {

            $category = DB::table('category_resort')
                ->where('category_resort.resort_id','=', $resort->resort_id)
                ->join('categories','categories.id','=','category_resort.category_id')
                ->get();

            $package = DB::table('packages')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $entrance = DB::table('entrances')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $cottage = DB::table('cottages')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $amenity = DB::table('amenities')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $frontpage = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->where('images.is_frontpage','=', 1)
                ->latest('updated_at')
                ->first();

            $image = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];

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

            foreach ($image as $key => $e) {
                $images[$key]['name'] = $e->filename;
                $images[$key]['location'] = $e->file_location;
                $images[$key]['is_frontpage'] = $e->is_frontpage;
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
                'frontpage' => $frontpage,
                'image' => $images,
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
        $kids = $request->kid;
        $adult = $request->adult;
        $budget = $request->budget;
        $day = $request->day;
        $night = $request->night;
        $category = $request->category;

        $tour = "";
        $selected_resort = array();

        // set tour if daytour or overnight or both
        if($day && $night)
            $tour = "AND (entrances.tour LIKE '%Daytour%' OR entrances.tour LIKE '%Overnight%')";
        if($day && !$night)
            $tour = "AND entrances.tour LIKE '%Daytour%'";
        if(!$day && $night)
            $tour = "AND entrances.tour LIKE '%Overnight%'";

        // get resort id by category query
        $resorts = DB::select("
            SELECT 
              *,
              resorts.id AS resort_id 
            FROM
              resorts
              LEFT JOIN category_resort
                ON category_resort.resort_id = resorts.id
              LEFT JOIN categories
                ON category_resort.category_id = categories.id
              LEFT JOIN entrances
                ON entrances.resort_id = resorts.id
                WHERE categories.name = '$category'
                $tour
                AND resorts.is_approve = 1 
                AND resorts.deleted_at IS NULL 
            GROUP BY resorts.name 
        ");

        // loop thru resort id to get budget
        foreach ($resorts as $resort) {
            $total_amount = 0; 
            $result = 0;

            $resort_id = $resort->resort_id;

            $resort_adult_rate = DB::select("
                SELECT 
                  min(rate) AS rate,
                  resort_id
                FROM
                  entrances 
                WHERE agetype = 'Adult' 
                  $tour
                  AND resort_id = $resort_id
            ");

            $resort_kid_rate = DB::select("
                SELECT 
                  MIN(rate) AS rate,
                  resort_id
                FROM
                  entrances 
                WHERE agetype = 'Kid' 
                  $tour
                  AND resort_id = $resort_id
            ");

            if (!is_null($resort_adult_rate[0]->rate)) {
                $total_amount = $total_amount + ($resort_adult_rate[0]->rate * $adult);
            }

            if (!is_null($resort_kid_rate[0]->rate)) {
                $total_amount = $total_amount + ($resort_adult_rate[0]->rate * $kids);
            }

             $cottage_rate = DB::select("
                SELECT 
                  MIN(rate) AS rate
                FROM
                  cottages 
                  WHERE resort_id = $resort_id     
            ");

            if (!is_null($cottage_rate[0]->rate)) {
                $total_amount = $total_amount + $cottage_rate[0]->rate;
            }

             $result = $budget - $total_amount;
             if ($result >= 0 && $result <= $budget && $total_amount > 0) {
                array_push($selected_resort, $resort->resort_id);
            }
            

        }

        // select resort based on category with budget
        $selected_resort = DB::table('resorts')->whereIn('id', $selected_resort)->get();

        // array that will hold search result of resort
        $data = [];
        foreach ($selected_resort as $index => $resort) {
            $category = DB::table('category_resort')
                ->where('category_resort.resort_id','=', $resort->id)
                ->join('categories','categories.id','=','category_resort.category_id')
                ->get();

            $package = DB::table('packages')
                ->where('resort_id','=', $resort->id)
                ->get();

            $entrance = DB::table('entrances')
                ->where('resort_id','=', $resort->id)
                ->get();

            $cottage = DB::table('cottages')
                ->where('resort_id','=', $resort->id)
                ->get();

            $amenity = DB::table('amenities')
                ->where('resort_id','=', $resort->id)
                ->get();

            $frontpage = DB::table('images')
                ->where('resort_id','=', $resort->id)
                ->where('images.is_frontpage','=', 1)
                ->latest('updated_at')
                ->first();

            $image = DB::table('images')
                ->where('resort_id','=', $resort->id)
                ->get();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];

            foreach ($category as $key => $c) {
                $categories[$key] = $c->name;
            }

            foreach ($image as $key => $c) {
                $images[$key]['location'] = $c->file_location;
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
                'image' => $images,
                'frontpage' => $frontpage
            ];

            array_push($data, $result);
        }

        $test = [
            'data' => $data,
            'result' => $selected_resort
        ];

        return $test;

    }

    public function trending()
    {
        $result = [];
        $resorts = Resort::query()
            ->where('is_approve','=',1)
            ->latest('updated_at')
            ->get();

        foreach ($resorts as $resort) {
            $res = DB::table('likes')
                ->where('resort_id','=', $resort->id)
                ->count();

            $data = [
                'resort' => $resort->name,
                'likes' => $res
            ];
            array_push($result, $data);
        }

        return collect($result)->sortByDesc('likes');
    }

    public function addLike(Request $request)
    {
        $like = DB::table('likes')
            ->insert([
                'resort_id' => $request[0],
                'email' => $request[1]
            ]);

        return 'success';
    }

    public function removeLike(Request $request)
    {
        $like = DB::table('likes')
            ->where('resort_id','=', $request[0])
            ->where('email','=', $request[1])
            ->delete();

        return 'success';
    }
}
