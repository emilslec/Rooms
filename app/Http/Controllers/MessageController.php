<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Game;
use App\Models\User;
use App\Models\Participant;
use App\Models\Message;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->content == null || $request->id == null) {
            return redirect()->route('rooms.index');
        }
        if (!Gate::allows('leave-room', Room::findOrfail($request->id))) {
            abort(403);
        }

        Message::create([
            'content' => $request->content,
            'room_id' => $request->id,
            'user_id' => Auth()->user()->id
        ]);

        return redirect()->route('rooms.show', $request->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
