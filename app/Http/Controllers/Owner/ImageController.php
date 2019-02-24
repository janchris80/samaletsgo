<?php

namespace App\Http\Controllers\Owner;

use App\Model\Image;
use App\Model\Resort;
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
        if ($request->hasFile('images')){
            $images = $request->file('images');
            $size = $images->getSize();
            dd($images);
        }
        else {
            return 'walaa';
        }
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
