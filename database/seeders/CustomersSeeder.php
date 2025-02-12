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
        ]);
    }
}