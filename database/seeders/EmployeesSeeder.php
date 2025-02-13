<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'person_id' => 1, // Zorg ervoor dat er een persoon met dit ID bestaat
                'number' => 'EMP001',
                'employee_type' => 'Manager',
                'is_active' => true,
                'note' => 'Initial employee record',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Voeg hier meer records toe als dat nodig is
        ]);
    }
}