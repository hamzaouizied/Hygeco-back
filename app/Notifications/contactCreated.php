<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ContactForm;

class ContactCreated extends Notification
{
    use Queueable;

    private $contactForm;

    public function __construct(ContactForm $contactForm)
    {
        $this->contactForm = $contactForm;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'New contact form submitted',
            'contact_id' => $this->contactForm->id,
            
            'object' => $this->contactForm->object,
            'note'=> $this->contactForm->note,
            'email'=> $this->contactForm->email,

        ];
        
    }
}