<?php

namespace App\Http\Controllers\Owner;

use App\Model\Amenity;
use App\Model\Category;
use App\Model\Cottage;
use App\Model\Entrance;
use App\Model\Image;
use App\Model\Package;
use App\Model\Resort;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Images;

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
            'file' => 'required|mime:JPG,PNG,GIF,JPEG',
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

        $images = $request->file('file');

        if(isset($images)) {
            $currentDate = Carbon::now()->toDateString();
            $size = $images->getSize();
            $name = $images->getClientOriginalName();
            $resize_name = str_slug($resort->name).'-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('resort'))
            {
                Storage::disk('public')->makeDirectory('resort');
            }
            $resortImage = Images::make($images)->resize(1600,1066)->stream();
            $path = Storage::disk('public')->put('resort/'.$resize_name, $resortImage);

            if ($path) {
                $img = new Image();
                $img->filename = $resize_name;
                $img->resort_id = $resort->id;
                $img->original_name = $name;
                $img->is_frontpage = 1;
                $img->size = $size;
                $img->file_location = 'http://178.128.124.60/storage/resort/'.$resize_name;
                $img->save();
            }
        }

        if($request->entrance_agetype) {
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

        return view('owner.resort.show',[
            'resort' => $resort,
            'categories' => $categories,
            'entrances' => $entrances,
            'cottages' => $cottages,
            'packages' => $packages,
            'amenities' => $amenities,
            'images' => $images,
        ]);
    }

    public function edit(Resort $resort)
    {
        $categories = Category::latest()->get();

        $category = DB::table('category_resort')
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

        return view('owner.resort.edit',[
            'resort' => $resort,
            'categories' => $categories,
            'category' => $category,
            'entrances' => $entrances,
            'cottages' => $cottages,
            'packages' => $packages,
            'amenities' => $amenities,
            'images' => $images,
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
