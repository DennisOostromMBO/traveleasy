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
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllMessages');

        // Create spGetAllMessages procedure
        $pathMessages = database_path('sp/communications/spGetAllMessages.sql');
        $sqlMessages = File::get($pathMessages);
        DB::unprepared($sqlMessages);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop procedure
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllMessages');
    }
};