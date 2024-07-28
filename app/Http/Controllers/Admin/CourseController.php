<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::paginate(10);

        if ($request->search) {
            $courses = Course::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $courses->appends(['search' => $request->search]);
        }

        $data = [
            'courses' => $courses,
        ];

        return view('admin.course.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            DB::beginTransaction();

            Course::create($request->all());

            DB::commit();

            return redirect()->route('courses.index')->with('alert-success', 'Thêm học phần thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm học phần thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $data = [
            'data_edit' => $course,
        ];

        return view('admin.course.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourseRequest $request, Course $course)
    {
        try {
            DB::beginTransaction();

            $course->update($request->all());

            DB::commit();

            return redirect()->route('courses.index')->with('alert-success', 'Sửa học phần thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa học phần thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            DB::beginTransaction();

            $course->destroy($course->id);

            DB::commit();

            return redirect()->route('courses.index')->with('alert-success', 'Xóa học phần thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa học phần thất bại!');
        }
    }
}
