<?php

namespace App\Http\Controllers\Owner;

use App\Model\Resort;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index()
    {
        $resort = Resort::query()
            ->where('user_id','=', Auth::id())
            ->latest()
            ->get();

        return view('admin.profile.index',[
            'profile' => Auth::user(),
            'resort' => $resort
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$postImage);

        } else {
            $imageName = "default.png";
        }

        $user = new User();
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.profile.edit',[
            'profile' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
