<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(MembershipTypeSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(MembershipSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(TrainerSeeder::class);
        $this->call(WorkoutPlanSeeder::class);
    }
}
