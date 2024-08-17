<?php

namespace App\Jobs;

use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserJob implements ShouldQueue
{
    use Queueable;

    public $subject;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($subject, $user)
    {
        $this->subject = $subject;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new UserMail($this->subject, $this->user));
    }
}
