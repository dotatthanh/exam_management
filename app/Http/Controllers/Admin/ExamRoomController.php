<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRoomRequest;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQA;
use App\Models\ExamRoom;
use App\Models\QA;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $examRooms = ExamRoom::query();

        $user = auth()->user();
        if ($user->hasRole('Sinh viên')) {
            $examRooms = $examRooms->where('class_id', $user->class_id);
        }
        if ($user->hasRole('Giáo viên')) {
            $examRooms = $examRooms->where('user_id', $user->id);
        }

        $examRooms = $examRooms->paginate(10);

        if ($request->search) {
            $examRooms = ExamRoom::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $examRooms->appends(['search' => $request->search]);
        }

        $data = [
            'examRooms' => $examRooms,
        ];

        return view('admin.exam-room.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'classes' => Classes::all(),
            'courses' => Course::all(),
            'users' => User::role('Giáo viên')->get(),
        ];

        return view('admin.exam-room.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRoomRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
            $params = $request->all();
            $params['start_time'] = Carbon::createFromFormat('H:i', $request->start_time);
            $params['end_time'] = Carbon::createFromFormat('H:i', $request->end_time);
            if (! $user->hasRole('Admin')) {
                $params['user_id'] = $user->id;
            }
            $examRoom = ExamRoom::create($params);

            for ($i = 1; $i <= $params['exam_quantity']; $i++) {
                $exam = Exam::create([
                    'exam_room_id' => $examRoom->id,
                    'code' => 'PT-'.$examRoom->id.'-'.$i,
                ]);

                for ($j = 1; $j <= Exam::TOTAL_QUESTIONS; $j++) {
                    $this->createExamQA($exam, $j);
                }
            }

            DB::commit();

            return redirect()->route('exam_rooms.index')->with('alert-success', 'Thêm phòng thi thành công!');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm phòng thi thất bại!');
        }
    }

    private function createExamQA($exam, $j)
    {
        do {
            $qa = QA::inRandomOrder()->first();
            $checkExists = ExamQA::where([
                'exam_id' => $exam->id,
                'qa_id' => $qa->id,
            ])->exists();
        } while ($checkExists);

        ExamQA::create([
            'exam_id' => $exam->id,
            'qa_id' => $qa->id,
            'index' => $j,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ExamRoom $examRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamRoom $examRoom)
    {
        $data = [
            'classes' => Classes::all(),
            'courses' => Course::all(),
            'data_edit' => $examRoom,
            'users' => User::role('Giáo viên')->get(),
        ];

        return view('admin.exam-room.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExamRoomRequest $request, ExamRoom $examRoom)
    {
        try {
            DB::beginTransaction();

            $examRoom->update($request->all());

            DB::commit();

            return redirect()->route('examRooms.index')->with('alert-success', 'Sửa phòng thi thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa phòng thi thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamRoom $examRoom)
    {
        try {
            DB::beginTransaction();

            $examRoom->destroy($examRoom->id);

            DB::commit();

            return redirect()->route('examRooms.index')->with('alert-success', 'Xóa phòng thi thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa phòng thi thất bại!');
        }
    }
}
