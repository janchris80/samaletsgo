<?php

namespace App\Http\Controllers\Owner;

use App\Model\Amenity;
use App\Model\Category;
use App\Model\Cottage;
use App\Model\Entrance;
use App\Model\Package;
use App\Model\Resort;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResortController extends Controller
{

    public function index()
    {
        $resorts = Resort::query()
            ->where('user_id','=', Auth::id())
            ->latest()
            ->get();
        return view('owner.resort.index',[
            'resorts' => $resorts
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('owner.resort.create',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'images' => 'required',
            'categories' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);

        $resort = new Resort();
        $resort->user_id = Auth::id();
        $resort->name = $request->name;
        $resort->slug = str_slug($request->name);
        $resort->description = $request->description;
        $resort->address = $request->address;
        $resort->save();

        $resort->categories()->attach($request->categories);

        $images = $request->file('image');

        if(isset($images)) {
            foreach ($images as $key => $datum) {
                $currentDate = Carbon::now()->toDateString();
                $imageName  = str_random(12).'-'.$currentDate.'-'.uniqid().'.'.$datum->getClientOriginalExtension();

                if(!Storage::disk('public')->exists('resort'))
                {
                    Storage::disk('public')->makeDirectory('resort');
                }

                $resortImage = Image::make($datum)->resize(1600,1066)->stream();
                Storage::disk('public')->put('resort/'.$imageName,$resortImage);

                $image = new Image();
                $image->resort_id = $resort->id;
                $image->filename = $imageName;
                $image->save();
            }
        }

        if($request->cottage_name) {
            foreach ($request->entrance_agetype as $key => $datum) {
                $entrance = new Entrance();
                $entrance->resort_id = $resort->id;
                $entrance->agetype = $request->entrance_agetype[$key];
                $entrance->description = $request->entrance_description[$key];
                $entrance->tour = $request->entrance_tour[$key];
                $entrance->rate = $request->entrance_rate[$key];
                $entrance->person = $request->entrance_person[$key];
                $entrance->save();
            }
        }

        if($request->cottage_name) {
            foreach ($request->cottage_name as $key => $datum) {
                $cottage = new Cottage();
                $cottage->resort_id = $resort->id;
                $cottage->name = $request->cottage_name[$key];
                $cottage->description = $request->cottage_description[$key];
                $cottage->rate = $request->cottage_rate[$key];
                $cottage->person = $request->cottage_person[$key];
                $cottage->save();
            }
        }

        if($request->amenity_name) {
            foreach ($request->amenity_name as $key => $datum) {
                $amenity = new Amenity();
                $amenity->resort_id = $resort->id;
                $amenity->name = $request->amenity_name[$key];
                $amenity->description = $request->amenity_description[$key];
                $amenity->rate = $request->amenity_rate[$key];
                $amenity->save();
            }
        }

        if ($request->package_name) {
            foreach ($request->package_name as $key => $datum) {
                $package = new Package();
                $package->resort_id = $resort->id;
                $package->name = $request->package_name[$key];
                $package->description = $request->package_description[$key];
                $package->rate = $request->package_rate[$key];
                $package->save();
            }
        }

        Toastr::success('Successfully Saved','Success');

        return redirect()->route('owner.resort.index');
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
            ORDER BY a.`updated_at` 
        ');


        return view('owner.resort.show',[
            'resort' => $resort,
            'categories' => $categories,
            'entrances' => $entrances,
            'cottages' => $cottages,
            'packages' => $packages,
            'amenities' => $amenities,
        ]);
    }

    public function edit(Resort $resort)
    {
        $categories = Category::latest()->get();

        $category = DB::select(
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
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
            AND r.`user_id` = '.Auth::id().'
            ORDER BY a.`updated_at` 
        ');


        return view('owner.resort.edit',[
            'resort' => $resort,
            'categories' => $categories,
            'category' => $category,
            'entrances' => $entrances,
            'cottages' => $cottages,
            'packages' => $packages,
            'amenities' => $amenities,
        ]);
    }

    public function update(Request $request, Resort $resort)
    {
        $valid = $this->validate($request,[
            'name' => 'required',
            'categories' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);

        $resort->user_id = Auth::id();
        $resort->name = $request->name;
        $resort->slug = str_slug($request->name);
        $resort->description = $request->description;
        $resort->address = $request->address;
        $resort->save();

        $resort->categories()->sync($request->categories);

        if($request->entrance_agetype) {
            if($valid) {
                Entrance::query()
                    ->where('resort_id', '=', $resort->id)
                    ->forceDelete();
            }
            foreach ($request->entrance_agetype as $key => $datum) {
                $entrance = new Entrance();
                $entrance->resort_id = $resort->id;
                $entrance->agetype = $request->entrance_agetype[$key];
                $entrance->description = $request->entrance_description[$key];
                $entrance->tour = $request->entrance_tour[$key];
                $entrance->rate = $request->entrance_rate[$key];
                $entrance->person = $request->entrance_person[$key];
                $entrance->save();
            }
        }

        if($request->cottage_name) {
            if($valid) {
                Cottage::query()
                    ->where('resort_id', '=', $resort->id)
                    ->forceDelete();
            }
            foreach ($request->cottage_name as $key => $datum) {
                $cottage = new Cottage();
                $cottage->resort_id = $resort->id;
                $cottage->name = $request->cottage_name[$key];
                $cottage->description = $request->cottage_description[$key];
                $cottage->rate = $request->cottage_rate[$key];
                $cottage->person = $request->cottage_person[$key];
                $cottage->save();
            }
        }

        if($request->amenity_name) {
            if($valid) {
                Amenity::query()
                    ->where('resort_id', '=', $resort->id)
                    ->forceDelete();
            }
            foreach ($request->amenity_name as $key => $datum) {
                $amenity = new Amenity();
                $amenity->resort_id = $resort->id;
                $amenity->name = $request->amenity_name[$key];
                $amenity->description = $request->amenity_description[$key];
                $amenity->rate = $request->amenity_rate[$key];
                $amenity->save();
            }
        }

        if($request->package_name) {
            if($valid) {
                Package::query()
                    ->where('resort_id', '=', $resort->id)
                    ->forceDelete();
            }
            foreach ($request->package_name as $key => $datum) {
                $package = new Package();
                $package->resort_id = $resort->id;
                $package->name = $request->package_name[$key];
                $package->description = $request->package_description[$key];
                $package->rate = $request->package_rate[$key];
                $package->save();
            }
        }

        Toastr::success('Successfully Updated','Success');

        return redirect()->route('owner.resort.index');
    }

    public function destroy(Resort $resort)
    {
        $resort->destroy($resort->id);
        $resort->update([
            'deleted_by' => Auth::id(),
        ]);

        Toastr::success('Successfully Deleted','Success');

        return redirect()->route('owner.resort.index');
    }
}
