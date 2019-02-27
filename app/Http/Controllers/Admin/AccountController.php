<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function index()
    {
        $users = User::query()
            ->where('id','!=', Auth::id())
            ->latest('updated_at')
            ->get();

        return view('admin.account.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->role_id == 1) {
            $user->role_id = 2;
        }
        else {
            $user->role_id = 1;
        }
        $user->save();

        Toastr::success('Successfully Updated' ,'Success');
        return redirect()->route('admin.account.index');
    }

    public function destroy($id)
    {
        //
    }
}
