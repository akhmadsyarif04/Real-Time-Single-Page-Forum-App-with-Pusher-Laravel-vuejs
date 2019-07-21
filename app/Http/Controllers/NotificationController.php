<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{

    public function index(){
      // readNotifications adalah defaul bawaan dari model user dengan nama   use Notifiable lalu use HasDatabaseNotifications nah didalam sana ada functions read and unread notifications
      return [
        'read' => NotificationResource::collection(auth()->user()->readNotifications()->get()),
        'unread' => NotificationResource::collection(auth()->user()->unreadNotifications()->get()),
      ];
    }

    public function markAsRead(Request $request){
      auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }
}
