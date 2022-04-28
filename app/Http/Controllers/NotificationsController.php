<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationsController extends Controller
{
    public function showNotifications()
    {
        $notifications = Notification::orderBy('id', 'desc')->get();
        return view("admin.show-notifications", [
            "notifications" => $notifications
        ]);
    }
    public function getNotificationsData()
    {
        $notifications = Notification::orderBy("id", "Desc")->get();
        $notifications_list = [];
        $count = count($notifications->where("seen", 0));
        foreach ($notifications as $notification) {
            if ($notification->seen == 0) {
                $type = $notification->notif_type;
                $link = $notification->link;
                $username = $notification->username;
                if ($type === 'comment') {
                    $icon = 'fas fa-comments text-teal';
                    $text = $username . ' left a comment';
                } else if ($type === 'order') {
                    $icon = 'fas fa-shopping-cart text-primary';
                    $text = $username . " ordered a book";
                } else if ($type === 'report') {
                    $icon = 'fas fa-exclamation-triangle text-danger';
                    $text = $username . " reported a link";
                } else if ($type === 'dcma') {
                    $icon = 'fas fa-radiation text-warning';
                    $text = $username . " reported a book";
                }
                $time = $notification->created_at->diffForHumans();
                $record = [
                    'icon' => $icon,
                    'text' => $text,
                    'time' => $time,
                    'link' => $link,
                    'id' => $notification->id,
                ];
                array_push($notifications_list, $record);
            }
        }
        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications_list as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                   {$not['time']}
                 </span>";

            $dropdownHtml .= "<a href='" . route('update.notification.status', $not['id']) . "' class='dropdown-item py-4'>
                            {$icon}{$not['text']}{$time}
                          </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label'       => $count,
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }

    public function updateStatus($id)
    {
        $notif = Notification::find($id);
        $notif->update([
            "seen" => 1
        ]);
        return redirect($notif->link);
    }

    public function delete($id)
    {
        $notif = Notification::find($id);
        $notif->delete();

        return back();
    }

    public function deleteAll(){
        Notification::truncate();
        return back();
    }
}
