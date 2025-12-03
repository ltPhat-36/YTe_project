<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment; // Biến chứa thông tin lịch hẹn

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác nhận lịch khám bệnh - Medpro',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_confirmed', // Trỏ đến file giao diện mail
        );
    }
}