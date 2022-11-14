<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    // Seeder User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Pembeli',
            'email' => 'pembeli@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

    // Seeder Produk
        Produk::create([
            'nama_barang' => 'Kacamata Photocromic',
            'gambar' => 'photocromic.png',
            'harga' => 260000,
            'stok' => 50,
            'keterangan' => 'Lensa sudah antiradiasi',
        ]);
        Produk::create([
            'nama_barang' => 'Jam Tangan',
            'gambar' => 'jam tangan anak.png',
            'harga' => 150000,
            'stok' => 50,
            'keterangan' => 'Jam tangan khusus untuk anak-anak',
        ]);
        Produk::create([
            'nama_barang' => 'Jam Tangan Pria | Berkualitas',
            'gambar' => 'jam tangan pria 1.png',
            'harga' => 250000,
            'stok' => 50,
            'keterangan' => 'Jam tangan original',
        ]);
        Produk::create([
            'nama_barang' => 'Kacamata Minus',
            'gambar' => 'minus.png',
            'harga' => 160000,
            'stok' => 50,
            'keterangan' => 'Lensa sudah antiradiasi',
        ]);
        Produk::create([
            'nama_barang' => 'Jam Tangan Wanita',
            'gambar' => 'jam tangan wanita.png',
            'harga' => 150000,
            'stok' => 50,
            'keterangan' => 'Jam tangan wanita elegan',
        ]);
        
        Produk::create([
            'nama_barang' => 'Jam Tangan Pria',
            'gambar' => 'jam tangan pria.png',
            'harga' => 195000,
            'stok' => 50,
            'keterangan' => 'Jam tangan pria yang berkualitas',
        ]);
    }
}
