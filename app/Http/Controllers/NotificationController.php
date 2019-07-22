<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]); // default
        // $this->middleware('auth:api', ['except' => ['login', 'signup']]);
        $this->middleware('JWT');  // middleware buatan baru,
        // selain dari pada didlm except tidak bisa digunakan function nya harus pake token JWT
        // yang di except bisa diakses tanpa token

    }

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
