<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Package;
use App\Model\Resort;
use App\Model\Review;
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

            $review = DB::table('reviews')
                ->where('resort_id','=', $resort->id)
                ->latest('updated_at')
                ->get();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];
            $rating = 0;
            $totalRating = 0;

            foreach ($category as $key => $c) {
                $categories[$key]['name'] = $c->name;
            }

            foreach ($image as $key => $e) {
                $images[$key]['name'] = $e->filename;
                $images[$key]['location'] = $e->file_location;
                $images[$key]['is_frontpage'] = $e->is_frontpage;
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

            foreach ($review as $item) {
                $totalRating += floatval($item->rating);
            }
            if ($review->count()) {
                $rating = floatval($totalRating) / floatval($review->count());
            }

            $result = [
                'id' => $resort->id,
                'name' => $resort->name,
                'address' => $resort->address,
                'description' => $resort->description,
                'lat' => $resort->lat,
                'lng' => $resort->lng,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
                'image' => $image,
                'frontpage' => $frontpage,
                'like' => 0,
                'like_count' => 0,
                'rating' => number_format($rating,2,'.',''),
                'totalRating' => number_format($totalRating,2,'.','')
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

        $resorts = DB::table('resorts')
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
              'resorts.lat AS resort_lat',
              'resorts.lng AS resort_lng',
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


        foreach ($resorts as $resort) {
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

            $image = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $frontpage = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->where('is_frontpage','=', 1)
                ->latest('updated_at')
                ->first();

            $review = DB::table('reviews')
                ->where('resort_id','=', $resort->resort_id)
                ->latest('updated_at')
                ->get();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];
            $rating = 0;
            $totalRating = 0;

            foreach ($category as $key => $c) {
                $categories[$key]['name'] = $c->name;
            }

            foreach ($image as $key => $e) {
                $images[$key]['name'] = $e->filename;
                $images[$key]['location'] = $e->file_location;
                $images[$key]['is_frontpage'] = $e->is_frontpage;
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

            foreach ($review as $item) {
                $totalRating += floatval($item->rating);
            }
            if ($review->count()) {
                $rating = floatval($totalRating) / floatval($review->count());
            }

            $result = [
                'id' => $resort->resort_id,
                'name' => $resort->resort_name,
                'address' => $resort->resort_address,
                'description' => $resort->resort_description,
                'lat' => $resort->resort_lat,
                'lng' => $resort->resort_lng,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
                'image' => $image,
                'frontpage' => $frontpage,
                'like' => 0,
                'like_count' => 0,
                'rating' => number_format($rating,2,'.',''),
                'totalRating' => number_format($totalRating,2,'.','')
            ];

            array_push($data, $result);
        }

        $result_data = [
            'result' => $resorts,
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
              resorts.id AS resort_id,
              resorts.name as resort_name,
              resorts.address as resort_address,
              resorts.lat as resort_lat,
              resorts.lng as resort_lng,
              resorts.description as resort_description
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


        foreach ($resorts as $resort) {
            $categ = DB::table('category_resort')
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

            $image = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $frontpage = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->where('is_frontpage','=', 1)
                ->latest('updated_at')
                ->first();

            $review = DB::table('reviews')
                ->where('resort_id','=', $resort->resort_id)
                ->latest('updated_at')
                ->get();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];
            $rating = 0;
            $totalRating = 0;

            foreach ($categ as $key => $c) {
                $categories[$key]['name'] = $c->name;
            }

            foreach ($image as $key => $e) {
                $images[$key]['name'] = $e->filename;
                $images[$key]['location'] = $e->file_location;
                $images[$key]['is_frontpage'] = $e->is_frontpage;
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

            foreach ($review as $item) {
                $totalRating += floatval($item->rating);
            }
            if ($review->count()) {
                $rating = floatval($totalRating) / floatval($review->count());
            }

            $result = [
                'id' => $resort->resort_id,
                'name' => $resort->resort_name,
                'address' => $resort->resort_address,
                'description' => $resort->resort_description,
                'lat' => $resort->resort_lat,
                'lng' => $resort->resort_lng,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
                'image' => $image,
                'frontpage' => $frontpage,
                'like' => 0,
                'like_count' => 0,
                'rating' => number_format($rating,2,'.',''),
                'totalRating' => number_format($totalRating,2,'.','')
            ];

            array_push($data, $result);
        }

        $result_data = [
            'data' => $data,
            'result' => $selected_resort
        ];

        return $result_data;

    }

    public function trending(Request $request)
    {
        $data = [];
        $resorts = DB::table('resorts')
            ->where('resorts.is_approve','=',1)
            ->where('resorts.deleted_at','=', NULL)
            ->join('likes','likes.resort_id','=','resorts.id')
            ->select(
                'resorts.id AS resort_id',
                'resorts.name AS resort_name',
                'resorts.address AS resort_address',
                'resorts.description AS resort_description',
                'resorts.lat AS resort_lat',
                'resorts.lng AS resort_lng'
            )
            ->groupBy('resorts.id')
            ->get();

        foreach ($resorts as $resort) {
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

            $image = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->get();

            $frontpage = DB::table('images')
                ->where('resort_id','=', $resort->resort_id)
                ->where('is_frontpage','=', 1)
                ->latest('updated_at')
                ->first();

            $like = DB::table('likes')
                ->where('resort_id','=', $resort->resort_id)
                ->where('email','=', $request->email)
                ->count();

            $like_count = DB::table('likes')
                ->where('resort_id','=', $resort->resort_id)
                ->count();

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];

            foreach ($category as $key => $c) {
                $categories[$key]['name'] = $c->name;
            }

            foreach ($image as $key => $e) {
                $images[$key]['name'] = $e->filename;
                $images[$key]['location'] = $e->file_location;
                $images[$key]['is_frontpage'] = $e->is_frontpage;
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
                'lat' => $resort->resort_lat,
                'lng' => $resort->resort_lng,
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

        $reeeeeeeeeeeeeeees = collect($resorts)->sortByDesc('like_count')->toArray();

        $result_data = [
            'result' => $reeeeeeeeeeeeeeees,
            'data' => $data
        ];

        return $result_data;
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

    public function review(Request $request)
    {
        $model = Review::query()
            ->where('email','=', $request->email)
            ->where('resort_id','=', $request->resort_id)
            ->get();

        if (!$request['display']) {
            if (!$model->count()) {
                $model = new Review();
                $model->resort_id = $request->resort_id;
                $model->email = $request->email;
                $model->rating = $request->rating;
                $model->comment = $request->comment;
                if (!$model->save()) {
                    return $data = [
                        'message' => 'Failed to save',
                        'data' => $model,
                        'exist' => false,
                    ];
                }
            }
        }
        return $data = [
            'message' => 'Already exist',
            'data' => $model,
            'exist' => $model->count() ? true : false,
        ];
    }

    public function reviews()
    {
        $model = Review::query()
            ->latest('updated_at')
            ->groupBy('resort_id')
            ->get();

        $rating = 0;
        $perRating = [];
        $totalRating = [];
        $resorts = [];

        foreach ($model as $datum) {
            $data = Review::query()
                ->where('resort_id','=', $datum->resort_id)
                ->get();

            $resort = Resort::query()
                ->find($datum->resort_id);

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

            $categories = [];
            $packages = [];
            $entrances = [];
            $cottages = [];
            $amenities = [];
            $images = [];

            foreach ($category as $key => $c) {
                $categories[$key]['name'] = $c->name;
            }

            foreach ($image as $key => $e) {
                $images[$key]['name'] = $e->filename;
                $images[$key]['location'] = $e->file_location;
                $images[$key]['is_frontpage'] = $e->is_frontpage;
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
                'lat' => $resort->lat,
                'lng' => $resort->lng,
                'category' => $categories,
                'package' => $packages,
                'entrance' => $entrances,
                'cottage' => $cottages,
                'amenity' => $amenities,
                'image' => $image,
                'frontpage' => $frontpage,
                'like' => 0,
                'like_count' => 0,
            ];

            array_push($resorts, $result);

            foreach ($data as $item) {
                $rating += floatval($item->rating);
            }
            array_push($totalRating, number_format($rating,2,'.',''));
            $rating = floatval($rating) / floatval($data->count());
            array_push($perRating, number_format($rating,2,'.',''));
            $rating = 0;
        }

        $data = [
            'perRating' => $perRating,
            'totalRating' => $totalRating,
            'resorts' => $resorts
        ];

//        dd($data);die;

        return $data;
    }
}
