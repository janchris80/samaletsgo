<?php

namespace App\Http\Controllers\Owner;

use App\Model\Image;
use App\Model\Resort;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Images;

class ImageController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
//        if ($request->hasFile('images')){
//            $images = $request->file('images');
//            $size = $images->getSize();
//            dd($images);
//        }
//        else {
//            return 'walaa';
//        }
//
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if($request->hasFile('images'))
        {

            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getExtension();

            if(!Storage::disk('public')->exists('resort'))
            {
                Storage::disk('public')->makeDirectory('resort');
            }
            $resortImage = Images::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('resort/'.$imageName,$resortImage);

        } else {
            $imageName = "default.png";
        }
        $img = new Image();
        $img->filename = $imageName;
        $img->type = $image->getType();
        $img->resort_id = $request->id;
        $img->save();


//
//        if (!empty($images)) {
//            foreach ($images as $image) {
//
////                $path = $image->store('resort','public');
//
//                $img = new Image();
//                $img->filename = $image->getClientOriginalName();
//                $img->type = $image->getClientMimeType();
//                $img->resort_id = $request->id;
//                $img->save();
//            }
//        }
//
//        return back();
    }

    public function show($id)
    {
        $resort = Resort::query()
            ->find($id);

        return view('owner.image.show',[
            'resort' => $resort
        ]);
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
