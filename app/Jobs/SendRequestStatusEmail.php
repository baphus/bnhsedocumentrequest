<?php

namespace App\Jobs;

use App\Mail\RequestStatusChanged;
use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRequestStatusEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Request $request;
    public string $oldStatus;
    public string $newStatus;

    /**
     * Create a new job instance.
     */
    public function __construct(Request $request, string $oldStatus, string $newStatus)
    {
        $this->request = $request;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Only send if the status has actually changed
        if ($this->oldStatus !== $this->newStatus) {
            Mail::to($this->request->email)->send(new RequestStatusChanged($this->request));
        }
    }
}
