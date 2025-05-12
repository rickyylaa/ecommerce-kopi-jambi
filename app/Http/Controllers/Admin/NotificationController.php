<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('id');
        Message::where('id', $notificationId)->update(['is_read' => 1]);
        return response()->json(['success' => true]);
    }
}
