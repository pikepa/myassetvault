<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Peter',
            'email' => 'pikepeter@gmail.com',
            'password' => bcrypt('pap4163Pap'),
            'role' => 'superadmin',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'SabahSocAdmin',
            'email' => 'sabahsoc@gmail.com',
            'password' => bcrypt('Membership2024'),
            'role' => 'admin',
        ]);

        //       \App\Models\Party::factory(10)->create();
        \App\Models\Transaction::factory(10)->create();
    }
}
