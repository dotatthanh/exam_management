<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMajorRequest;
use App\Models\Department;
use App\Models\Major;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $majors = Major::query();

        if ($request->search) {
            $majors = $majors->where('name', 'like', '%'.$request->search.'%');
        }

        $majors = $majors->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'majors' => $majors,
        ];

        return view('admin.major.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'departments' => Department::all(),
        ];

        return view('admin.major.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMajorRequest $request)
    {
        try {
            DB::beginTransaction();

            Major::create($request->all());

            DB::commit();

            return redirect()->route('majors.index')->with('alert-success', 'Thêm chuyên ngành thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm chuyên ngành thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        $data = [
            'user' => $major,
        ];

        return view('admin.major.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        $data = [
            'data_edit' => $major,
            'departments' => Department::all(),
        ];

        return view('admin.major.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMajorRequest $request, Major $major)
    {
        try {
            DB::beginTransaction();

            $major->update($request->all());

            DB::commit();

            return redirect()->route('majors.index')->with('alert-success', 'Sửa chuyên ngành thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa chuyên ngành thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        try {
            DB::beginTransaction();

            if ($major->classes()->count() > 0) {
                return redirect()->back()->with('alert-error', 'Xóa chuyên ngành thất bại! Chuyên ngành '.$major->name.' đang tồn tại những lớp học.');
            }
            $major->destroy($major->id);

            DB::commit();

            return redirect()->route('majors.index')->with('alert-success', 'Xóa chuyên ngành thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa chuyên ngành thất bại!');
        }
    }
}
