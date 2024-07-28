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
        $examRooms = ExamRoom::paginate(10);

        if ($request->search) {
            $examRooms = ExamRoom::where('question', 'like', '%'.$request->search.'%')->paginate(10);
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

            $examRoom = ExamRoom::create($request->all());

            for ($i = 1; $i <= $request->exam_quantity; $i++) {
                $exam = Exam::create([
                    'exam_room_id' => $examRoom->id,
                    'code' => 'PT-'.$examRoom->id.'-'.$i,
                ]);

                for ($j = 1; $j <= 10; $j++) {
                    $this->createExamQA($exam);
                }
            }

            DB::commit();

            return redirect()->route('exam_rooms.index')->with('alert-success', 'Thêm câu hỏi và đáp án thành công!');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm câu hỏi và đáp án thất bại!');
        }
    }

    private function createExamQA($exam)
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

            return redirect()->route('examRooms.index')->with('alert-success', 'Sửa câu hỏi và đáp án thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa câu hỏi và đáp án thất bại!');
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

            return redirect()->route('examRooms.index')->with('alert-success', 'Xóa câu hỏi và đáp án thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa câu hỏi và đáp án thất bại!');
        }
    }
}
