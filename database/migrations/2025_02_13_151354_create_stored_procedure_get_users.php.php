<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');
        DB::unprepared('
            CREATE PROCEDURE spGetAllUsers()
            BEGIN
                SELECT 
                    u.id AS user_id,
                    CONCAT(u.first_name, " ", COALESCE(u.middle_name, ""), " ", u.last_name) AS full_name,
                    u.email,
                    u.email_verified_at,
                    u.is_logged_in,
                    u.logged_in_at,
                    u.logged_out_at,
                    u.is_active,
                    u.comments,
                    u.full_name,
                    r.name AS role_name,
                    CONCAT(p.first_name, " ", COALESCE(p.middle_name, ""), " ", p.last_name) AS person_full_name
                FROM 
                    users u
                LEFT JOIN 
                    roles r ON u.role_id = r.id
                LEFT JOIN 
                    persons p ON u.person_id = p.id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllUsers');
    }
};
