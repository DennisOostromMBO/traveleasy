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
        // Drop existing procedures if they exist
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllCustomers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetCustomerById');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateCustomer');
        DB::unprepared('DROP PROCEDURE IF EXISTS spCreateCustomer');

        // Create spGetAllCustomers procedure
        $pathGetAll = database_path('sp/customers/spGetAllCustomers.sql');
        DB::unprepared(File::get($pathGetAll));

        // Create spGetCustomerById procedure
        $pathGetById = database_path('sp/customers/spGetCustomerById.sql');
        DB::unprepared(File::get($pathGetById));

        // Create spUpdateCustomer procedure
        $pathUpdate = database_path('sp/customers/spUpdateCustomer.sql');
        DB::unprepared(File::get($pathUpdate));

        // Create spCreateCustomer procedure
        $pathCreate = database_path('sp/customers/spCreateCustomer.sql');
        DB::unprepared(File::get($pathCreate));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop all procedures
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllCustomers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetCustomerById');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateCustomer');
        DB::unprepared('DROP PROCEDURE IF EXISTS spCreateCustomer');
    }
};