<?php

namespace App\Jobs;

use App\Mail\TaskDoneToAdminEmail;
use App\Mail\TaskDoneToDepartmentEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTaskDoneEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailAdmins;

    protected $task;

    protected $emailDepartments;

    /**
     * Create a new job instance.
     */
    public function __construct(array $emailAdmins, array $task, array $emailDepartments)
    {
        $this->emailAdmins = $emailAdmins;
        $this->task = $task;
        $this->emailDepartments = $emailDepartments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailAdmins = $this->emailAdmins;
        $task = $this->task;
        $emailDepartments = $this->emailDepartments;

        foreach ($emailAdmins as $emailAdmin) {
            Mail::to($emailAdmin)->send(new TaskDoneToAdminEmail($task));
        }
        foreach ($emailDepartments as $emailDepartment) {
            Mail::to($emailDepartment)->send(new TaskDoneToDepartmentEmail($task));
        }
    }
}
