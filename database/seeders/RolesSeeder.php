<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $emp1 = new Role();
        $emp1->rol = "ADMINISTRADOR";
        $emp1->save();

        $emp2 = new Role();
        $emp2->rol = "GERENTE";
        $emp2->save();

        $emp3 = new Role();
        $emp3->rol = "FINANZAS";
        $emp3->save();
        //
    }
}
