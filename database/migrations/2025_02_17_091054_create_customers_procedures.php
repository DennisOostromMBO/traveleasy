<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop existing procedure if it exists
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllCustomers');

        // Create spGetAllCustomers procedure
        $pathCustomers = database_path('sp/customers/spGetAllCustomers.sql');
        $sqlCustomers = File::get($pathCustomers);
        DB::unprepared($sqlCustomers);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop procedure
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllCustomers');
    }
};