<?php

namespace App\Http\Controllers\Owner;

use App\Model\Resort;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Images;

class ProfileController extends Controller
{

    public function index()
    {
        $resort = Resort::query()
            ->where('user_id','=', Auth::id())
            ->latest('updated_at')
            ->get();

        return view('owner.profile.index',[
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

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->updateProfile == 'changePassword') {
            $this->validate($request,[
                'password' => 'required|string|min:6|confirmed'
            ]);
            $user->password = Hash::make($request->password);
            $user->save();

            Toastr::success('Successfully Changed Password' ,'Success');
        }
        else {
            $images = $request->file('file');

            if($request->hasFile('file')) {
                $currentDate = Carbon::now()->toDateString();
                $resize_name = str_slug($user->name).'-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                if(!Storage::disk('public')->exists('profile'))
                {
                    Storage::disk('public')->makeDirectory('profile');
                }
                $profileImage = Images::make($images)->resize(1600,1066)->stream();
                $path = Storage::disk('public')->put('profile/'.$resize_name, $profileImage);

                if ($path) {
                    $user->image = $resize_name;
                    $user->save();

                    Toastr::success('Successfully Changed Picture' ,'Success');
                }
            }
        }
        return redirect()->route('owner.profile.index');
    }

    public function destroy($id)
    {
        //
    }
}
