<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'password' => bcrypt('rahasia'),
        ]);

        // 24 Users biasa
        $users = [
            ['name' => 'Ali', 'email' => 'ali@gmail.com'],
            ['name' => 'Budi', 'email' => 'budi@gmail.com'],
            ['name' => 'Caca', 'email' => 'caca@gmail.com'],
            ['name' => 'Deni', 'email' => 'deni@gmail.com'],
            ['name' => 'Eka', 'email' => 'eka@gmail.com'],
            ['name' => 'Fira', 'email' => 'fira@gmail.com'],
            ['name' => 'Gilang', 'email' => 'gilang@gmail.com'],
            ['name' => 'Hana', 'email' => 'hana@gmail.com'],
            ['name' => 'Icha', 'email' => 'icha@gmail.com'],
            ['name' => 'Joko', 'email' => 'joko@gmail.com'],
            ['name' => 'Kiki', 'email' => 'kiki@gmail.com'],
            ['name' => 'Lala', 'email' => 'lala@gmail.com'],
            ['name' => 'Mira', 'email' => 'mira@gmail.com'],
            ['name' => 'Nina', 'email' => 'nina@gmail.com'],
            ['name' => 'Ojan', 'email' => 'ojan@gmail.com'],
            ['name' => 'Putri', 'email' => 'putri@gmail.com'],
            ['name' => 'Qori', 'email' => 'qori@gmail.com'],
            ['name' => 'Raka', 'email' => 'raka@gmail.com'],
            ['name' => 'Salsa', 'email' => 'salsa@gmail.com'],
            ['name' => 'Tari', 'email' => 'tari@gmail.com'],
            ['name' => 'Umar', 'email' => 'umar@gmail.com'],
            ['name' => 'Vina', 'email' => 'vina@gmail.com'],
            ['name' => 'Wulan', 'email' => 'wulan@gmail.com'],
            ['name' => 'Zaki', 'email' => 'zaki@gmail.com'],
            ['name' => 'Yuni', 'email' => 'yuni@gmail.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'is_admin' => false,
                'password' => bcrypt('12345678'),
            ]);
        }
    }
}
