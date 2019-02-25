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

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        Image::query()
            ->where('filename','=', $filename)
            ->delete();

        return response()->json([$request]);
    }

    public function upload(Request $request, $id)
    {
        if ($request->hasFile('file')){
            $resort = Resort::query()
                ->find($id);

            $currentDate = Carbon::now()->toDateString();
            $images = $request->file('file');
            $size = $images->getSize();
            $name = $images->getClientOriginalName();
            $resize_name = str_slug($resort->name).'-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('resort'))
            {
                Storage::disk('public')->makeDirectory('resort');
            }
            $resortImage = Images::make($images)->resize(1600,1066)->stream();
            $path = Storage::disk('public')->put('resort/'.$resize_name,$resortImage);

            if ($path) {
                $img = new Image();
                $img->filename = $resize_name;
                $img->resort_id = $id;
                $img->original_name = $name;
                $img->size = $size;
                $img->file_location = 'http://178.128.124.60/storage/resort/'.$resize_name;
                $img->save();
                return response()->json([$resize_name]);
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
