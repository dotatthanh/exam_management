<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusCounts = Task::selectRaw('status, COUNT(*) as count');

        $user = auth()->user();
        if (! $user->hasRole('Admin')) {
            $statusCounts = $statusCounts->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $statusCounts = $statusCounts->groupBy('status')
            ->orderBy('status')
            ->get()
            ->toArray();

        $status = array_column($statusCounts, 'status');
        $statusTasks = getConst('statusTasks');
        foreach ($status as $key => &$item) {
            $item = $statusTasks[$key];
        }

        $data = [
            'data' => $statusCounts,
            'counts' => array_column($statusCounts, 'count'),
            'status' => $status,
            'statusColors' => getConst('statusColors'),
            'statusTasks' => $statusTasks,
        ];

        return view('admin.dashboard', $data);
    }
}
