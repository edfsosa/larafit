<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Admin');

        // Crear entrenadores
        User::factory(3)->create()->each(function ($user) {
            $user->assignRole('Entrenador');
            Trainer::create(['user_id' => $user->id]);
        });

        // Crear miembros
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('Miembro');
            Member::create(['user_id' => $user->id]);
        });
    }
}
