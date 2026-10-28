<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            [
                'nama' => 'dr. Estes, Sp.A',
                'email' => 'dokter@gmail.com',
                'no_ktp' => '3374090105890006',
                'no_hp' => '082200001006',
                'alamat' => 'Jl. Majapahit No. 35, Kel. Gayamsari, Kec. Gayamsari, Kota Semarang',
                'kode_poli' => 'B',
            ],
            [
                'nama' => 'dr. Layla',
                'email' => 'dokter2@gmail.com',
                'no_ktp' => '3374010101900002',
                'no_hp' => '081200001002',
                'alamat' => 'Jl. Pemuda No. 25, Kel. Sekayu, Kec. Semarang Tengah, Kota Semarang',
                'kode_poli' => 'C',
            ],
            [
                'nama' => 'drg. Miya',
                'email' => 'dokter3@gmail.com',
                'no_ktp' => '3374084102920003',
                'no_hp' => '081300001003',
                'alamat' => 'Jl. Ngesrep Timur V No. 18, Kel. Sumurboto, Kec. Banyumanik, Kota Semarang',
                'kode_poli' => 'D',
            ],
            [
                'nama' => 'dr. Kagura, Sp.M',
                'email' => 'dokter4@gmail.com',
                'no_ktp' => '3374124303950004',
                'no_hp' => '085700001004',
                'alamat' => 'Jl. Prof. Soedarto No. 42, Kel. Tembalang, Kec. Tembalang, Kota Semarang',
                'kode_poli' => 'E',
            ],
            [
                'nama' => 'dr. Angela, Sp.PD',
                'email' => 'dokter5@gmail.com',
                'no_ktp' => '3374154404940005',
                'no_hp' => '082100001005',
                'alamat' => 'Jl. Pamularsih Raya No. 16, Kel. Salamanmloyo, Kec. Semarang Barat, Kota Semarang',
                'kode_poli' => 'F',
            ],
        ];

        foreach ($dokters as $data) {
            $poli = Poli::where('kode_poli', $data['kode_poli'])->firstOrFail();
            unset($data['kode_poli']);

            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    ...$data,
                    'password' => Hash::make('dokter'),
                    'id_poli' => $poli->id,
                    'role' => 'dokter',
                ]
            );
        }
    }
}