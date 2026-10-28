<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'POLI UMUM',
                'kode_poli' => 'C',
                'keterangan' => 'Konsultasi kesehatan umum, pemeriksaan awal, dan penanganan keluhan ringan hingga sedang.',
                'tarif' => 150000,
            ],
            [
                'nama_poli' => 'POLI GIGI',
                'kode_poli' => 'D',
                'keterangan' => 'Pemeriksaan dan konsultasi kesehatan gigi serta mulut. Tindakan khusus dikenakan biaya tambahan.',
                'tarif' => 250000,
            ],
            [
                'nama_poli' => 'POLI MATA',
                'kode_poli' => 'E',
                'keterangan' => 'Konsultasi dan pemeriksaan dasar gangguan kesehatan mata.',
                'tarif' => 200000,
            ],
            [
                'nama_poli' => 'POLI PENYAKIT DALAM',
                'kode_poli' => 'F',
                'keterangan' => 'Konsultasi dan pemeriksaan penyakit organ dalam bagi pasien dewasa.',
                'tarif' => 275000,
            ],
            [
                'nama_poli' => 'POLI KIA',
                'kode_poli' => 'G',
                'keterangan' => 'Layanan konsultasi kesehatan ibu dan anak, termasuk pemeriksaan kehamilan dasar.',
                'tarif' => 200000,
            ],
        ];

        foreach ($polis as $poli) {
            Poli::firstOrCreate(
                ['nama_poli' => $poli['nama_poli']],
                $poli
            );
        }
    }
}