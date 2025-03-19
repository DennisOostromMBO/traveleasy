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
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllTravels');
        DB::unprepared('DROP PROCEDURE IF EXISTS spCreateTravel');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateTravel');

        // Create spGetAllTravels procedure
        $pathTravels = database_path('sp/travels/spGetAllTravels.sql');
        $sqlTravels = File::get($pathTravels);
        DB::unprepared($sqlTravels);

        // Create spCreateTravel procedure
        $pathCreateTravel = database_path('sp/travels/spCreateTravel.sql');
        $sqlCreateTravel = File::get($pathCreateTravel);
        DB::unprepared($sqlCreateTravel);

        // Create spUpdateTravel procedure
        $pathUpdateTravel = database_path('sp/travels/spUpdateTravel.sql');
        $sqlUpdateTravel = File::get($pathUpdateTravel);
        DB::unprepared($sqlUpdateTravel);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop procedures
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllTravels');
        DB::unprepared('DROP PROCEDURE IF EXISTS spCreateTravel');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateTravel');
    }
};