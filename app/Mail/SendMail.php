<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Entities\Setting;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $details;
    public $title;

    public function __construct($details, $title)
    {
        //

        $this->details = $details;
        $this->title = $title;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $setting = Setting::with('logo')->first();

        $this->details['logo'] = $setting->logo;


        return $this->subject("$setting->site_name | $this->title")
            ->view('mail::simple');
    }
}
