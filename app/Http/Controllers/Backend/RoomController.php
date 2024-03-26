<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $data['q_search'] = "";
        $data['get_room'] = DB::table('rooms')
            ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')
            ->select('rooms.*', 'room_types.room_type_name')
            ->where('room_active', '1')
            ->paginate(config('app.row'));
        return view('backend.room.index', $data);

    }

    public function search(Request $req)
    {
        $q_search = $req->q_search;
        $data['get_room'] = DB::table('rooms')
            ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')
            ->select('rooms.*', 'room_types.room_type_name')
            ->where('room_active', '1')
            ->where(function ($query) use ($q_search) {
                $query->orWhere('rooms.room_name', 'LIKE', "%{$q_search}%")
                    ->orWhere('rooms.room_desc', 'LIKE', "%{$q_search}%");
            })
            ->paginate(config('app.row'));
        $data['q_search'] = $q_search;
        return view('backend.room.index', $data);
    }

    public function create()
    {

//        $room_type = DB::table('room_types')->get();
        $room_type = RoomType::all();
        return view('backend.room.create_room', compact('room_type'));
    }

    public function save(Request $req)
    {
        $req->validate([
                'room_name' => 'required|string|max:191',
                'room_desc' => 'required',
                'room_type_id' => 'required',
            ]
        );

        if ($req->room_photo) {
            $data['room_photo'] = $req->file('room_photo')->store('uploads/room', 'custom');
        } else {
            $data['room_photo'] = null;
        }

        try {
            $data = array(
                'room_name' => $req->room_name,
                'room_desc' => $req->room_desc,
                'room_status' => $req->room_status,
                'room_photo' => $data['room_photo'],
                'room_type_id' => $req->room_type_id,
            );

            $i = DB::table('rooms')->insert($data);

            if ($i) {
                return redirect('room/create')->with('success', 'Room has been added !!!');
            }
        } catch (QueryException) {

            return back()->with('error', 'Something went wrong!');
        }

    }

    public function edit($id)
    {
        $room_type = RoomType::all();
        $room = DB::table('rooms')
            ->where('room_id', $id)
            ->first();
        return view('backend.room.update_room', compact('room_type', 'room'));
    }

    public function update(Request $req)
    {
        $data = $req->except('_token', 'room_id', 'room_photo');
        if ($req->room_photo) {
            $data['room_photo'] = $req->file('room_photo')->store('uploads/room', 'custom');
        }
        $i = DB::table('rooms')
            ->where('room_id', $req->room_id)
            ->update($data);
        if ($i) {
            return redirect('room/edit/' . $req->room_id)->with('success', 'Room has been updated !!!');
        }
    }

    public function deactivate($id)
    {
        $room = DB::table('rooms')
            ->where('room_id', $id)
            ->update(['room_active' => '0']);
        return redirect('room');
    }

}


