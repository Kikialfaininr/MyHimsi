<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $name; // Tambahkan properti $name

    // Ubah konstruktor untuk menerima $name
    public function __construct($name, $password)
    {
        $this->name = $name; // Simpan nilai $name
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your New Account Password')
                    ->view('emails.password_notification')
                    ->with([
                        'password' => $this->password,
                        'name' => $this->name, // Tambahkan $name ke view
                    ]);
    }
}
