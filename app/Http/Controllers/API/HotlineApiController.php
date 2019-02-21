<?php

namespace App\Http\Controllers\API;

use App\Model\Hotline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotlineApiController extends Controller
{
    public function index()
    {
        return Hotline::all();
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
        //
    }
    public function destroy($id)
    {
        //
    }
}
