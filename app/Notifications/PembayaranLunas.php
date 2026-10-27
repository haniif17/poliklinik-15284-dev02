<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PembayaranLunas extends Notification
{
    use Queueable;

    public function __construct(
        private readonly int $periksaId,
        private readonly string $namaPoli
    )
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'pembayaran_lunas',
            'title' => 'Pembayaran lunas',
            'periksa_id' => $this->periksaId,
            'message' => 'Pembayaran Anda untuk poli ' . $this->namaPoli . ' telah diverifikasi dan dinyatakan lunas.',
        ];
    }
}