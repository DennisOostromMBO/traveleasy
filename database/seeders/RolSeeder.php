<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        Rol::create([
            'id' => 1,
            'name' => 'Administrator',
            'note' => 'Administrator van de TravelEasy',
        ]);

        Rol::create([
            'id' => 2,
            'name' => 'Medewerker',
            'note' => 'Medewerker van de TravelEasy',
        ]);

        Rol::create([
            'id' => 3,
            'name' => 'Klant',
            'note' => 'Klant van de TravelEasy',
        ]);

        Rol::create([
            'id' => 4,
            'name' => 'Gastgebruiker',
            'note' => 'Gastgebruiker van de TravelEasy',
        ]);
    }
}