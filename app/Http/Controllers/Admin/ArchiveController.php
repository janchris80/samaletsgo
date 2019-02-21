<?php

namespace App\Http\Controllers\Admin;

use App\Model\Event;
use App\Model\Hotline;
use App\Model\Resort;
use App\Model\Tourist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchiveController extends Controller
{

    public function index()
    {
        $resort = Resort::onlyTrashed()->get();
        $event = Event::onlyTrashed()->get();
        $hotline = Hotline::onlyTrashed()->get();
        $tourist = Tourist::onlyTrashed()->get();

        return view('admin.archive.index',[
            'resorts' => $resort,
            'events' => $event,
            'hotlines' => $hotline,
            'tourists' => $tourist,
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
        //
    }

    public function destroy(Request $request, $id)
    {
        $delete = $request->delete;
        if($delete === 'resort') {
            Resort::withTrashed()
                ->where('id', $id)
                ->restore();
        }

        if($delete === 'event') {
            Event::withTrashed()
                ->where('id', $id)
                ->restore();
        }

        if($delete === 'hotline') {
            Hotline::withTrashed()
                ->where('id', $id)
                ->restore();
        }

        if($delete === 'tourist') {
            Tourist::withTrashed()
                ->where('id', $id)
                ->restore();
        }

        return redirect()->route('admin.archive.index');
    }
}
