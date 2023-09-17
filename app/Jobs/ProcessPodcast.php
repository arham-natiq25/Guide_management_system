<?php

namespace App\Jobs;

use App\Mail\CustomerDetailSend;
use App\Mail\GuideBookedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $guide;
    protected $res;
    protected $randomPassword;

    /**
     * Create a new job instance.
     */
    public function __construct($guide, $res, $randomPassword)
    {
        $this->guide = $guide;
        $this->res = $res;
        $this->randomPassword = $randomPassword;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->guide->user->email)->send(new GuideBookedMail($this->res));
        // Mail::to($this->res->user->email)->send(new CustomerDetailSend($this->res, $this->randomPassword));
    }
}
