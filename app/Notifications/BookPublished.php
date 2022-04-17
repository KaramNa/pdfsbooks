<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
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
        $image = \Storage::get('public' . substr($book->poster, 8));
        $interventionImage = \Image::make($image)->encode("png", 100);
        $interventionImage->save('public/images/tempImg.png');
        $cover = 'public/images/tempImg.png';
        // return TelegramFile::create()
        //     ->to('@e_pdfsbooks')
        //     ->content("Free Download available *Now*\n*" . $book->title . "*")
        //     ->file($cover, 'photo')
        //     ->button('Free Download', 'https://pdfsbooks.com/book/' . $book->slug);
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
