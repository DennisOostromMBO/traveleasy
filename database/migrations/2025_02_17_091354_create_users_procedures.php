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
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllRoles');

        // Create spGetAllUsers procedure
        $pathUsers = database_path('sp/users/spGetAllUsers.sql');
        $sqlUsers = File::get($pathUsers);
        DB::unprepared($sqlUsers);

        // Create spGetAllRoles procedure
        $pathRoles = database_path('sp/roles/spGetAllRoles.sql');
        $sqlRoles = File::get($pathRoles);
        DB::unprepared($sqlRoles);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop procedures
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllRoles');
    }
};