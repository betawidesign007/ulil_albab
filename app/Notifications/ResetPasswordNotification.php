<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(public string $token) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Permintaan Reset Kata Sandi - SIMPONPES Li Ulil Albab')
            ->greeting("Assalamu'alaikum Warahmatullahi Wabarakatuh, {$notifiable->name}")
            ->line('Kami menerima permintaan untuk mereset kata sandi akun SIMPONPES Anda.')
            ->action('Atur Ulang Kata Sandi', $resetUrl)
            ->line('Tautan reset kata sandi ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini dan kata sandi Anda akan tetap aman.')
            ->salutation("Wassalamu'alaikum,\nAdmin SIMPONPES Pondok Pesantren Li Ulil Albab");
    }
}
