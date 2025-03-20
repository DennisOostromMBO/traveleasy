<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // Create a specific person
        $person = Person::create([
            'first_name' => 'Man',
            'middle_name' => 'Ag',
            'last_name' => 'Er',
            'date_of_birth' => '1990-01-01', // Voeg een waarde toe voor date_of_birth
            'is_active' => 1, // Voeg een waarde toe voor is_active
        ]);

        // Create a specific user linked to the person
        User::create([
            'person_id' => $person->id,
            'role_id' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('1'),
            'is_active' => 1,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
