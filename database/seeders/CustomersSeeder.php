<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'persons_id' => 1, 
                'relation_number' => 'REL12345',
                'is_active' => true,
                'note' => 'First test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 2, 
                'relation_number' => 'REL67890',
                'is_active' => true,
                'note' => 'Second test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 3, 
                'relation_number' => 'REL11111',
                'is_active' => true,
                'note' => 'Third test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 4, 
                'relation_number' => 'REL22222',
                'is_active' => true,
                'note' => 'Fourth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 5, 
                'relation_number' => 'REL33333',
                'is_active' => true,
                'note' => 'Fifth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 6, 
                'relation_number' => 'REL44444',
                'is_active' => true,
                'note' => 'Sixth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 7, 
                'relation_number' => 'REL55555',
                'is_active' => true,
                'note' => 'Seventh test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 8, 
                'relation_number' => 'REL66666',
                'is_active' => true,
                'note' => 'Eighth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 9, 
                'relation_number' => 'REL77777',
                'is_active' => true,
                'note' => 'Ninth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 10, 
                'relation_number' => 'REL88888',
                'is_active' => true,
                'note' => 'Tenth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
