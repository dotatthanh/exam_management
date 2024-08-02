<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamRoom;
use App\Models\ExamUser;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $examRooms = ExamRoom::where('end_time', '<', now());

        $user = auth()->user();
        if ($user->hasRole('Sinh viên')) {
            $examRooms = $examRooms->where('class_id', $user->class_id);
        }
        if ($user->hasRole('Giáo viên')) {
            $examRooms = $examRooms->where('user_id', $user->id);
        }

        if ($request->search) {
            $examRooms = $examRooms->where('name', 'like', '%'.$request->search.'%');
        }

        $examRooms = $examRooms->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'examRooms' => $examRooms,
        ];

        return view('admin.exam-result.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $examRoomId)
    {
        $examUsers = ExamUser::where('exam_room_id', $examRoomId);

        if ($request->search) {
            $examUsers = $examUsers->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        }

        $examUsers = $examUsers->get();

        $data = [
            'examUsers' => $examUsers,
            'examRoomId' => $examRoomId,
        ];

        return view('admin.exam-result.show', $data);
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
