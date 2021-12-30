<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function update($id){
        $notif = Notification::find($id);
        $notif->update([
            "seen" => 1
        ]);
        return redirect($notif->link);
    }

    public function delete($id){
        $notif = Notification::find($id);
        $notif->delete();

        return back();
    }
}
