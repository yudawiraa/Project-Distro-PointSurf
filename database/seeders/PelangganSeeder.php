<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggans = [
            [
                'nama_pelanggan' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'no_telepon' => '081234567890',
                'email' => 'budi.santoso@email.com',
            ],
            [
                'nama_pelanggan' => 'Siti Rahayu',
                'alamat' => 'Jl. Pahlawan No. 45, Bandung',
                'no_telepon' => '082345678901',
                'email' => 'siti.rahayu@email.com',
            ],
            [
                'nama_pelanggan' => 'Ahmad Hidayat',
                'alamat' => 'Jl. Sudirman No. 78, Surabaya',
                'no_telepon' => '083456789012',
                'email' => 'ahmad.hidayat@email.com',
            ],
            [
                'nama_pelanggan' => 'Dewi Putri',
                'alamat' => 'Jl. Gatot Subroto No. 90, Medan',
                'no_telepon' => '084567890123',
                'email' => 'dewi.putri@email.com',
            ],
            [
                'nama_pelanggan' => 'Rudi Hermawan',
                'alamat' => 'Jl. Ahmad Yani No. 56, Semarang',
                'no_telepon' => '085678901234',
                'email' => 'rudi.hermawan@email.com',
            ],
            [
                'nama_pelanggan' => 'Nina Wati',
                'alamat' => 'Jl. Diponegoro No. 34, Yogyakarta',
                'no_telepon' => '086789012345',
                'email' => 'nina.wati@email.com',
            ],
            [
                'nama_pelanggan' => 'Eko Prasetyo',
                'alamat' => 'Jl. Veteran No. 67, Malang',
                'no_telepon' => '087890123456',
                'email' => 'eko.prasetyo@email.com',
            ],
            [
                'nama_pelanggan' => 'Maya Sari',
                'alamat' => 'Jl. Pemuda No. 89, Palembang',
                'no_telepon' => '088901234567',
                'email' => 'maya.sari@email.com',
            ],
            [
                'nama_pelanggan' => 'Doni Kusuma',
                'alamat' => 'Jl. Asia Afrika No. 12, Bandung',
                'no_telepon' => '089012345678',
                'email' => 'doni.kusuma@email.com',
            ],
            [
                'nama_pelanggan' => 'Rina Agustina',
                'alamat' => 'Jl. Thamrin No. 23, Jakarta',
                'no_telepon' => '081123456789',
                'email' => 'rina.agustina@email.com',
            ]
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggan::create($pelanggan);
        }
    }
}
