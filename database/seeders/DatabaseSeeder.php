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


        // Call the custom seeders
        $this->call([
            EmployeesSeeder::class, // Voeg de EmployeesSeeder toe
            personsSeeder::class,
            CustomersSeeder::class,
            ContactsSeeder::class,
            CommunicationsSeeder::class, // Voeg de CommunicationsSeeder toe

        ]);
    }
}