<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BuktiPembayaranDiupload extends Notification
{
    use Queueable;

    public function __construct(
        private readonly int $periksaId,
        private readonly string $namaPasien,
        private readonly string $namaPoli
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'bukti_pembayaran_diupload',
            'title' => 'Bukti pembayaran baru',
            'periksa_id' => $this->periksaId,
            'message' => $this->namaPasien . ' mengunggah bukti pembayaran untuk poli ' . $this->namaPoli . '.',
        ];
    }
}