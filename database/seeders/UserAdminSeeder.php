<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Juan José',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('prueba123'),
        ])->assignRole('Administrador');
    }
}
