<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQARequest;
use App\Models\QA;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qas = QA::paginate(10);

        if ($request->search) {
            $qas = QA::where('question', 'like', '%'.$request->search.'%')->paginate(10);
            $qas->appends(['search' => $request->search]);
        }

        $data = [
            'qas' => $qas,
        ];

        return view('admin.qa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.qa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQARequest $request)
    {
        try {
            DB::beginTransaction();

            QA::create($request->all());

            DB::commit();

            return redirect()->route('qas.index')->with('alert-success', 'Thêm câu hỏi và đáp án thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm câu hỏi và đáp án thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(QA $qa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(QA $qa)
    {
        $data = [
            'data_edit' => $qa,
        ];

        return view('admin.qa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQARequest $request, QA $qa)
    {
        try {
            DB::beginTransaction();

            $qa->update($request->all());

            DB::commit();

            return redirect()->route('qas.index')->with('alert-success', 'Sửa câu hỏi và đáp án thành công!');
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
    public function destroy(QA $qa)
    {
        try {
            DB::beginTransaction();

            $qa->destroy($qa->id);

            DB::commit();

            return redirect()->route('qas.index')->with('alert-success', 'Xóa câu hỏi và đáp án thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa câu hỏi và đáp án thất bại!');
        }
    }
}
