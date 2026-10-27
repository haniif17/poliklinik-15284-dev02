<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(string $notification): RedirectResponse
    {
        $ownedNotification = Auth::user()
            ->notifications()
            ->whereKey($notification)
            ->firstOrFail();

        $ownedNotification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
}