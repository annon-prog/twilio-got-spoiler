<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Spoiler;
use App\Models\PhoneNumber;
use App\Services\Twilio;

class SendGotSpoiler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $spoiler;

    protected $twilio;

    protected $phoneNumbers;

    /**
     * Create a new job instance.
     */
    public function __construct(Twilio $twilio)
    {
        $this->spoiler = Spoiler::latest()->first();

        $this->phoneNumbers =PhoneNumber::all();

        $this->twilio = $twilio;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $twilio = $this->twilio;

        $this->phoneNumbers->map(function ($phoneNumber) use ($twilio){
            $twilio->notify($phoneNumber->phone_number, $this->spoiler->message);
        });
    }
}
