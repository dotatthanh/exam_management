<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamQA;
use App\Models\ExamRoom;
use App\Models\ExamUser;
use App\Models\QaResult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    // Vào phòng thi
    public function exam(Request $request, $examUserId)
    {
        $examUser = ExamUser::with('examRoom')->find($examUserId);
        if (empty($examUser)) {
            abort(404);
        }

        $examRoom = $examUser->examRoom;
        if ($examRoom->isBeforeStartTime()) {
            return redirect()->back()->with('alert-error', 'Chưa tới giờ thi.');
        }
        if ($examRoom->isAfterEndTime()) {
            return redirect()->back()->with('alert-error', 'Đã hết giờ thi.');
        }

        $questionIndex = $this->handleQuestionIndex($request->question);

        $examQA = ExamQA::with('qa')->where([
            'exam_id' => $examUser->exam_id,
            'index' => $questionIndex,
        ])->first();
        if (empty($examQA)) {
            abort(404);
        }

        $result = QaResult::where([
            'exam_user_id' => $examUserId,
            'qa_id' => $examQA->qa->id,
        ])->first();

        $data = [
            'examQA' => $examQA,
            'examRoom' => $examRoom,
            'examUser' => $examUser,
            'result' => $result,
            'questionIndex' => $questionIndex,
        ];

        return view('admin.exam.create', $data);
    }

    private function handleQuestionIndex($question)
    {
        $questionIndex = 1;
        if (isset($question)) {
            if ($question >= 1 && $question <= Exam::TOTAL_QUESTIONS) {
                $questionIndex = $question;
            } elseif ($question > Exam::TOTAL_QUESTIONS) {
                $questionIndex = Exam::TOTAL_QUESTIONS;
            }
        }

        return $questionIndex;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    // Tạo đề thi cho sinh viên
    public function storeExam($examRoomId)
    {
        $user = auth()->user();
        $examRoom = ExamRoom::find($examRoomId);
        if (empty($examRoom) ||
            $examRoom->class_id != $user->class_id) {
            abort(404);
        }

        $examUser = ExamUser::where([
            'user_id' => $user->id,
            'exam_room_id' => $examRoomId,
        ])->first();

        if (empty($examUser)) {
            $exam = Exam::where('exam_room_id', $examRoomId)->inRandomOrder()->first();
            $examUser = ExamUser::create([
                'user_id' => $user->id,
                'exam_room_id' => $examRoomId,
                'exam_id' => $exam->id,
            ]);
        }

        return redirect()->route('exams.exam', $examUser->id);
    }

    private function handleResult($request)
    {
        $result = QaResult::where([
            'exam_user_id' => $request->exam_user_id,
            'qa_id' => $request->qa_id,
        ])->first();

        if (empty($result)) {
            $result = QaResult::create($request->all());
        } else {
            $result->update($request->all());
        }

        return $result;
    }

    // Lưu thông tin câu trả lời
    public function storeAnswer(Request $request)
    {
        try {
            DB::beginTransaction();

            $result = $this->handleResult($request);
            $qa = $result->qa;

            $relativePath = 'uploads/exam';
            $sourceFileName = 'test.c';
            $executableFileName = 'test';
            $sourceFilePath = public_path("$relativePath/$sourceFileName");
            $outputFilePath = public_path("$relativePath/$executableFileName");
            Storage::disk('public_uploads')->put("/exam/$sourceFileName", $request->answer);

            if (Storage::disk('public_uploads')->exists("/exam/$sourceFileName")) {
                $compile_output = shell_exec("gcc $sourceFilePath -o $outputFilePath 2>&1");
                if ($compile_output) {
                    $result->update(['is_correct' => false]);
                    Log::error('-----> Code đang lỗi rồi! qa_result id = '.$result->id);
                    DB::commit();

                    return $this->responseError(Response::HTTP_BAD_REQUEST, null, $compile_output);
                } else {
                    $input = str_replace(';', "\n", $qa->input)."\n";
                    $descriptorSpec = [
                        0 => ['pipe', 'r'],  // stdin
                        1 => ['pipe', 'w'],  // stdout
                    ];

                    $process = proc_open($outputFilePath, $descriptorSpec, $pipes);

                    if (is_resource($process)) {
                        // Gửi dữ liệu vào chương trình C
                        // fwrite($pipes[0], "$a\n$b\n");
                        fwrite($pipes[0], $input);
                        fclose($pipes[0]);

                        // Đọc kết quả từ chương trình C
                        $output = stream_get_contents($pipes[1]);
                        fclose($pipes[1]);

                        proc_close($process);

                        $answer = nl2br($output); // Sử dụng nl2br để hiển thị xuống dòng
                        if (strcmp($answer, $qa->answer) == 0) {
                            $result->update(['is_correct' => true]);
                        } else {
                            $result->update(['is_correct' => false]);
                        }
                    }
                }
            } else {
                Log::error('-----> Không lưu được file code bài làm. qa_result id = '.$result->id);
                DB::commit();

                return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, null, 'Có lỗi xảy ra!');
            }

            DB::commit();

            return $this->responseSuccess(Response::HTTP_OK, $result);
        } catch (Exception $e) {
            DB::rollback();

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, null, 'Có lỗi xảy ra!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function calculateExamScore(Request $request) {
        $examUser = ExamUser::find($request->exam_user_id);
        if (empty($examUser)) {
            return $this->responseError(Response::HTTP_BAD_REQUEST, null);
        }

        return $this->responseSuccess(Response::HTTP_OK, $examUser->calculateExamScore());
    }
}
