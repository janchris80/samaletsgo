<?php

namespace App\Http\Controllers\Admin;

use App\Model\Event;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{

    public function index()
    {
        $data = Event::latest()->get();

        return view('admin.event.index',[
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'address' => $request->address,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        Toastr::success('Successfully Saved' ,'Success');
        return redirect()->route('admin.event.index');
    }

    public function show(Event $event)
    {
        return view('admin.event.show',[
            'event' => $event
        ]);
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit',[
            'data' => $event
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        Toastr::success('Successfully Updated' ,'Success');
        return redirect()->route('admin.event.index');
    }

    public function destroy(Event $event)
    {
        Event::destroy($event->id);
        Toastr::success('Successfully Deleted' ,'Success');
        return redirect()->route('admin.event.index');
    }
}
