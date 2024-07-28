<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::query();

        if ($request->search) {
            $departments = $departments->where('name', 'like', '%'.$request->search.'%');
        }

        $departments = $departments->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'departments' => $departments,
        ];

        return view('admin.department.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();

            Department::create($request->all());

            DB::commit();

            return redirect()->route('departments.index')->with('alert-success', 'Thêm khoa thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm khoa thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $data = [
            'user' => $department,
        ];

        return view('admin.department.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $data = [
            'data_edit' => $department,
        ];

        return view('admin.department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepartmentRequest $request, Department $department)
    {
        try {
            DB::beginTransaction();

            $department->update($request->all());

            DB::commit();

            return redirect()->route('departments.index')->with('alert-success', 'Sửa khoa thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa khoa thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        try {
            DB::beginTransaction();

            if ($department->majors()->count() > 0) {
                return redirect()->back()->with('alert-error', 'Xóa khoa thất bại! Khoa '.$department->name.' đang tồn tại những chuyên ngành.');
            }
            $department->destroy($department->id);

            DB::commit();

            return redirect()->route('departments.index')->with('alert-success', 'Xóa khoa thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa khoa thất bại!');
        }
    }
}
