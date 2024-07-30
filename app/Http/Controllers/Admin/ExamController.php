<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamQA;
use App\Models\ExamRoom;
use App\Models\ExamUser;
use App\Models\QaResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    // Vào phong thi
    public function exam(Request $request, $examUserId)
    {
        $examUser = ExamUser::with('examRoom')->find($examUserId);
        if (empty($examUser)) {
            abort(404);
        }

        $questionIndex = $this->handleQuestionIndex($request->question);

        $examQA = ExamQA::with('qa')->where([
            'exam_id' => $examUser->exam_id,
            'index' => $questionIndex,
        ])->first();

        $result = QaResult::where([
            'exam_user_id' => $examUserId,
            'qa_id' => $examQA->qa->id,
        ])->first();

        $data = [
            'examQA' => $examQA,
            'examRoom' => $examUser->examRoom,
            'examUser' => $examUser,
            'result' => $result,
            'questionIndex' => $questionIndex,
        ];

        return view('admin.exam.create', $data);
    }

    private function handleQuestionIndex($question) {
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

    private function handleResult ($request) {
        $result = QaResult::where([
            'exam_user_id' => $request->exam_user_id,
            'qa_id' => $request->qa_id,
        ])->first();

        if (empty($result)) {
            $result = QaResult::create($request->all());
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

            $outputFilePath = public_path('uploads/exam/test');
            if (Storage::disk('public_uploads')->exists("/exam/$sourceFileName")) {
                $compile_output = shell_exec("gcc $sourceFilePath -o $outputFilePath 2>&1");
                if ($compile_output) {
                    // Log::error("-----> Code đang lỗi rồi!");
                    Log::error("-----> Code đang lỗi rồi!");
                    // dd('Code đang lỗi rồi!'.$compile_output);
                    return $this->responseError(Response::HTTP_BAD_REQUEST, null, $compile_output);
                } else {
                    // $a = 7;
                    // $b = 8;
                    // $output = shell_exec("$outputFilePath $a $b");
                    // dd($output);

                    // dd(123);
                    $input = str_replace(';', "\n", $qa->input)."\n";
                    $descriptorSpec = [
                        0 => ["pipe", "r"],  // stdin
                        1 => ["pipe", "w"],  // stdout
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

                        $answer = nl2br($output);
                        if (strcmp($answer, $qa->answer) == 0) {
                            $result->update(['is_correct' => true]);
                        } else {
                            $result->update(['is_correct' => false]);
                        }
                        // echo $answer; // Sử dụng nl2br để hiển thị xuống dòng
                    }
                }
            } else {
                // dd('Lưu file thất bại!');
                // Log::error("-----> Không lưu được file code bài làm");
                Log::error("-----> Không lưu được file code bài làm");
                return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, null, 'Có lỗi xảy ra!');
            }

            DB::commit();
            return $this->responseSuccess(Response::HTTP_OK, $result);

            return redirect()->route('courses.index')->with('alert-success', 'Thêm học phần thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm học phần thất bại!');
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
}
