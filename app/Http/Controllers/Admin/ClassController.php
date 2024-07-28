<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRequest;
use App\Models\Classes;
use App\Models\Major;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::paginate(10);

        if ($request->search) {
            $classes = Classes::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $classes->appends(['search' => $request->search]);
        }

        $data = [
            'classes' => $classes,
        ];

        return view('admin.class.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'majors' => Major::all(),
        ];

        return view('admin.class.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassRequest $request)
    {
        try {
            DB::beginTransaction();

            Classes::create($request->all());

            DB::commit();

            return redirect()->route('classes.index')->with('alert-success', 'Thêm lớp học thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm lớp học thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        $data = [
            'data_edit' => $class,
            'majors' => Major::all(),
        ];

        return view('admin.class.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClassRequest $request, Classes $class)
    {
        try {
            DB::beginTransaction();

            $class->update($request->all());

            DB::commit();

            return redirect()->route('classes.index')->with('alert-success', 'Sửa lớp học thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa lớp học thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        try {
            DB::beginTransaction();

            $class->destroy($class->id);

            DB::commit();

            return redirect()->route('classes.index')->with('alert-success', 'Xóa lớp học thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa lớp học thất bại!');
        }
    }
}
