<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
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
        return view('admin.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $code = $request->code;

        $relativePath = 'uploads/exam';
        $sourceFileName = 'test.c';
        $executableFileName = 'test';
        $sourceFilePath = public_path("$relativePath/$sourceFileName");
        $outputFilePath = public_path("$relativePath/$executableFileName");

        Storage::disk('public_uploads')->put("/exam/$sourceFileName", $code);

        $outputFilePath = public_path("uploads/exam/test");
        if (Storage::disk('public_uploads')->exists("/exam/$sourceFileName")) {
            // dd($sourceFilePath, $outputFilePath);
            $compile_output = shell_exec("gcc $sourceFilePath -o $outputFilePath 2>&1");
            if ($compile_output) {
                dd("Code đang lỗi rồi!". $compile_output);
            } else {
                $a = 7;
                $output = shell_exec("$outputFilePath $a");
                dd($output);

                // if (Storage::disk('public_uploads')->exists("/exem/test.exe")) {
                //     dd('ok');
                //     // Truyền tham số và chạy chương trình C (nếu cần)
                //     // $a = 3;
                //     // $b = 5;
                //     // $output = shell_exec("$outputFilePath $a $b");
                //     // echo $output;
                // } else {
                //     dd("Tệp thực thi không được tạo ra!");
                // }
            }
        } else {
            dd("Lưu file thất bại!");
        }
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
