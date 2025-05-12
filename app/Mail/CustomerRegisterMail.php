<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $customer;
    protected $randomPassword;

    //MEMINTA DATA BERUPA INFORMASI CUSTOMER DAN RANDOM PASSWORD YANG BELUM DI-ENCRYPT
    public function __construct(Customer $customer, $randomPassword)
    {
        $this->customer = $customer;
        $this->randomPassword = $randomPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //MENGESET SUBJECT EMAIL, VIEW MANA YANG AKAN DI-LOAD DAN DATA APA YANG AKAN DIPASSING KE VIEW
        return $this->subject('Verifikasi Pendaftaran Anda')
            ->view('emails.register')
            ->with([
                'customer' => $this->customer,
                'password' => $this->randomPassword
            ]);
    }
}