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
                'relation_number' => 'TE-00001',
                'is_active' => true,
                'note' => 'First test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 2, 
                'relation_number' => 'TE-00002',
                'is_active' => true,
                'note' => 'Second test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 3, 
                'relation_number' => 'TE-00003',
                'is_active' => true,
                'note' => 'Third test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 4, 
                'relation_number' => 'TE-00004',
                'is_active' => true,
                'note' => 'Fourth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 5, 
                'relation_number' => 'TE-00005',
                'is_active' => true,
                'note' => 'Fifth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 6, 
                'relation_number' => 'TE-00006',
                'is_active' => true,
                'note' => 'Sixth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 7, 
                'relation_number' => 'TE-00007',
                'is_active' => true,
                'note' => 'Seventh test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 8, 
                'relation_number' => 'TE-00008',
                'is_active' => true,
                'note' => 'Eighth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 9, 
                'relation_number' => 'TE-00009',
                'is_active' => true,
                'note' => 'Ninth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 10, 
                'relation_number' => 'TE-00010',
                'is_active' => true,
                'note' => 'Tenth test customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
