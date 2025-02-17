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
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllTravels');

        // Create spGetAllTravels procedure
        $pathTravels = database_path('sp/travels/spGetAllTravels.sql');
        $sqlTravels = File::get($pathTravels);
        DB::unprepared($sqlTravels);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop procedure
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllTravels');
    }
};