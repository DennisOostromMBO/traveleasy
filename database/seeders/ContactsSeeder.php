<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'customer_id' => 1,
                'street_name' => 'Main Street',
                'house_number' => '123',
                'addition' => 'Apt 1',
                'postal_code' => '12345',
                'city' => 'Anytown',
                'mobile' => '555-1234',
                'email' => 'john.doe@example.com',
                'is_active' => true,
                'note' => 'First test contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2, 
                'street_name' => 'Second Street',
                'house_number' => '456',
                'addition' => null,
                'postal_code' => '67890',
                'city' => 'Othertown',
                'mobile' => '555-5678',
                'email' => 'jane.smith@example.com',
                'is_active' => true,
                'note' => 'Second test contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}