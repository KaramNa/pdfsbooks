<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramChannel;

class BookPublished extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($book)
    {
        $image = 'public' .  substr($book->poster, 8);
        if (Storage::exists('public/temptemp.jpg'))
            Storage::delete('public/temptemp.jpg');
        Storage::copy($image, 'public/temptemp.jpg');
        return TelegramFile::create()
            ->to('@e_pdfsbooks')
            ->content("Free Download available *Now*\n*" . $book->title . "*")
            ->file('public/storage/temptemp.jpg', 'photo')
            ->button('Free Download', 'https://pdfsbooks.com/book/' . $book->slug);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
