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
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllBookings');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllCustomers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllMessages');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllTravels');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');

        // Create spGetAllBookings procedure
        $pathCustomers = database_path('sp/Bookings/spGetAllBookings.sql');
        $sqlCustomers = File::get($pathCustomers);
        DB::unprepared($sqlCustomers);

        // Create spGetAllCustomers procedure
        $pathCustomers = database_path('sp/customers/spGetAllCustomers.sql');
        $sqlCustomers = File::get($pathCustomers);
        DB::unprepared($sqlCustomers);

        // Create spGetAllMessages procedure
        $pathMessages = database_path('sp/communications/spGetAllMessages.sql');
        $sqlMessages = File::get($pathMessages);
        DB::unprepared($sqlMessages);

        // Create spGetAllTravels procedure
        $pathTravels = database_path('sp/travels/spGetAllTravels.sql');
        $sqlTravels = File::get($pathTravels);
        DB::unprepared($sqlTravels);

       // Create spGetAllUsers procedure
       $pathUsers = database_path('sp/users/spGetAllUsers.sql');
       $sqlUsers = File::get($pathUsers);
       DB::unprepared($sqlUsers);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop procedures
        //Dennis
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllCustomers');
        //Fatih
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllMessages');
        //Fatih
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllTravels');
        //Daniel
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');
    }
};