<?php

namespace App\Http\Controllers\Owner;

use App\Model\Image;
use App\Model\Resort;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $data = [];
        if ($request->hasFile('images')){
            $currentDate = Carbon::now()->toDateString();
            $images = $request->file('images');
            $size = $images->getSize();
            $type = $images->getClientMimeType();
            $name = $images->getClientOriginalName();
            $ext = $currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
            $data = [
                'size' => $size,
                'type' => $type,
                'original_name' => $name,
                'resize_name' => $ext,
                'image' => $images
            ];

            dd($data);

        }
        else {
            return 'walaa';
        }

//        $slug = str_slug($request->name);
//        if($request->hasFile('images'))
//        {
//
//            $currentDate = Carbon::now()->toDateString();
//            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
//
//            if(!Storage::disk('public')->exists('resort'))
//            {
//                Storage::disk('public')->makeDirectory('resort');
//            }
//            $resortImage = Images::make($image)->resize(1600,1066)->stream();
//            Storage::disk('public')->put('resort/'.$imageName,$resortImage);
//
//        } else {
//            $imageName = "default.png";
//        }
//        $img = new Image();
//        $img->filename = $imageName;
//        $img->type = $image->extension();
//        $img->resort_id = $request->id;
//        $img->save();
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
