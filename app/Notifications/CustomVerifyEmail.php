<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Selamat Datang di Aplikasi Kami')
            ->line('Terima kasih telah mendaftar di aplikasi kami. Klik tombol di bawah ini untuk memverifikasi alamat email Anda.')
            ->action('Verifikasi Email Sekarang', $this->verificationUrl($notifiable))
            ->line('Jika Anda tidak mendaftar, Anda dapat mengabaikan email ini.')
            ->line('Terima kasih atas kepercayaan Anda!');
    }

    protected function verificationUrl($notifiable)
    {
        return route('verification.verify', [
            'id' => $notifiable->getKey(),
            'hash' => hash('sha256', $notifiable->getEmailForVerification()),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
