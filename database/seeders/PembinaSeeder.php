<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Eskul;

class PembinaSeeder extends Seeder
{
    public function run(): void
    {
        $dataPembina = [
            ['nama' => 'ridwan', 'email' => 'futsal@gmail.com', 'eskul' => 'Futsal'],
            ['nama' => 'franklin', 'email' => 'badminton@gmail.com', 'eskul' => 'Badminton'],
            ['nama' => 'dewi', 'email' => 'karawitan@gmail.com', 'eskul' => 'Karawitan'],
            ['nama' => 'yayan', 'email' => 'basket@gmail.com', 'eskul' => 'Basket'],
            ['nama' => 'rasendria', 'email' => 'voli@gmail.com', 'eskul' => 'Voli'],
        ];

        foreach ($dataPembina as $data) {

            // 🔥 Buat / ambil user pembina
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['nama'],
                    'password' => '12345678', // auto hash
                    'role' => 'pembina',
                    'is_admin' => 0
                ]
            );

            // 🔥 Hubungkan ke eskul
            Eskul::where('nama_eskul', $data['eskul'])
                ->update(['pembina_id' => $user->id]);
        }
    }
}