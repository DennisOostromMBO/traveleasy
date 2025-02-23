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
        \App\Models\Person::factory(10)->create();

        // Call the custom seeders
        $this->call([
            CustomersSeeder::class,
            ContactsSeeder::class,
            RolSeeder::class,
            EmployeesSeeder::class, // Voeg de EmployeesSeeder toe
            CommunicationsSeeder::class, // Voeg de CommunicationsSeeder toe
            DeparturesSeeder::class,
            DestinationsSeeder::class,
            TravelsSeeder::class,
            BookingSeeder::class,
            InvoiceSeeder::class,
        ]);


        \App\Models\User::factory(10)->create();

    }
}
