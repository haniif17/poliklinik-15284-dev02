<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obatObatan = [
            ['nama_obat' => 'Amoxicillin 500 mg', 'kemasan' => 'Strip', 'harga' => 18000, 'stok' => 80],
            ['nama_obat' => 'Ibuprofen 400 mg', 'kemasan' => 'Strip', 'harga' => 12000, 'stok' => 60],
            ['nama_obat' => 'Cetirizine 10 mg', 'kemasan' => 'Strip', 'harga' => 8000, 'stok' => 75],
            ['nama_obat' => 'Omeprazole 20 mg', 'kemasan' => 'Strip', 'harga' => 20000, 'stok' => 50],
            ['nama_obat' => 'Antasida DOEN', 'kemasan' => 'Strip', 'harga' => 5000, 'stok' => 100],
            ['nama_obat' => 'Metformin 500 mg', 'kemasan' => 'Strip', 'harga' => 10000, 'stok' => 80],
            ['nama_obat' => 'Amlodipine 5 mg', 'kemasan' => 'Strip', 'harga' => 12000, 'stok' => 65],
            ['nama_obat' => 'Oralit', 'kemasan' => 'Sachet', 'harga' => 2000, 'stok' => 120],
            ['nama_obat' => 'Vitamin C 500 mg', 'kemasan' => 'Strip', 'harga' => 15000, 'stok' => 70],
            ['nama_obat' => 'Salbutamol 2 mg', 'kemasan' => 'Strip', 'harga' => 8000, 'stok' => 50],
        ];

        foreach ($obatObatan as $obat) {
            Obat::firstOrCreate(
                ['nama_obat' => $obat['nama_obat']],
                $obat
            );
        }
    }
}