<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profil::create([
           'id' => Profil::ADMIN,
           'name' => 'Administrateur',
           'uuid' => Str::uuid()
        ]);

        Profil::create([
            'id' => Profil::CUSTOMER,
            'name' => 'Client',
            'uuid' => Str::uuid()
        ]);

        User::create([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'Shop',
            'email' => 'admin@shop.com',
            'password' => bcrypt('password'),
            'profil_id' => Profil::ADMIN,
            'email_verified_at' => now(),
            'last_logged_at' => now(),
        ]);
    }
}
