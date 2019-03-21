<?php

namespace App\Http\Controllers\API;

use App\Model\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountApiController extends Controller
{

    public function index()
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $data = [];
        $account = Account::query()
            ->where('email','=', $request->email)
            ->where('password','=', $request->password)
            ->get();

        if (count($account)) {
            return $data = [
                'account' => $account,
                'token' => str_random(36),
                'success' => true
            ];
        }

        return $data = [
            'account' => '',
            'token' => '',
            'success' => false
        ];
    }

    public function register(Request $request)
    {
        csrf_token();
        $data = [];
        $account = Account::query()
            ->where('email','=', $request->email)
            ->where('first_name','=', $request->first_name)
            ->get();

        if (count($account)) {
            return $data = [
                'account' => $account,
                'token' => '',
                'success' => false
            ];
        }
        else {
            $user = new Account();
            $user->email = $request->email;
            $user->password = $request->password;
            $user->picture = 'http://178.128.124.60/storage/profile/default.jpg';
            $user->first_name = $request->first_name;
            $user->username = $request->first_name;
            $user->save();

            return $data = [
                'account' => $user,
                'token' => str_random(36),
                'success' => true
            ];
        }
    }
}
