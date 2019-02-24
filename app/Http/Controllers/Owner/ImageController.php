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

    }

    public function destroy($id)
    {
        //
    }

    public function fileDestroy(Request $request, $name)
    {
//        $filename =  $request->get('filename');
//        Image::query()
//            ->where('filename','=', $filename)
//            ->delete();
//        $path=public_path().'/images/'.$filename;
//        if (file_exists($path)) {
//            unlink($path);
//        }
//        return $filename;
        return response()->json([$request]);
    }

    public function upload(Request $request, $id)
    {
        if ($request->hasFile('file')){
            $currentDate = Carbon::now()->toDateString();
            $images = $request->file('file');
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
            if(!Storage::disk('public')->exists('resort'))
            {
                Storage::disk('public')->makeDirectory('resort');
            }
            $resortImage = Images::make($images)->resize(1600,1066)->stream();
            $path = Storage::disk('public')->put('resort/'.$ext,$resortImage);

            if ($path) {
                $img = new Image();
                $img->filename = $ext;
                $img->resort_id = $id;
                $img->file_location = 'storage/resort/'.$ext;
                $img->save();
                return response()->json([$ext]);
            }
            else {
                return response()->json(['error'=> 'somethings wrong inside path']);
            }
        }
        else {
            return response()->json(['error'=> 'somethings wrong or null file']);
        }
    }
}
