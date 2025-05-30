<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $penggunas = [
            [
                'nama_pengguna' => 'Admin System',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'nama_pengguna' => 'Karyawan 1',
                'username' => 'karyawan1',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
            ],
            [
                'nama_pengguna' => 'Karyawan 2',
                'username' => 'karyawan2',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
            ],
            [
                'nama_pengguna' => 'Karyawan 3',
                'username' => 'karyawan3',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
            ],
            [
                'nama_pengguna' => 'Admin 2',
                'username' => 'admin2',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        ];

        foreach ($penggunas as $pengguna) {
            Pengguna::create($pengguna);
        }
    }
}