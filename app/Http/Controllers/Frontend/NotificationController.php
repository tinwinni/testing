<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(5);
        
        return view('frontend.notification',compact('notifications'));
    }
    public function show($id){
        $user = auth()->guard('web')->user();
        $notification = $user->notifications()->where('id',$id)->firstOrFail();
        $notification->markAsRead();
        return view('frontend.notification_detail',compact('notification'));

    }
}
