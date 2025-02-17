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
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');

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
        // Drop procedure
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');
    }
};