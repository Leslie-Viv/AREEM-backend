<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $emp1 = new User();
        $emp1->nombreempresa = "Bodega";
        $emp1->nombrecompleto = "Edgar Anguiano";
        $emp1->email = "admin@gmail.com";
        $emp1->password = bcrypt('password12345');
        $emp1->rol_id = 1;
        $emp1->save();
        //
        $emp2 = new User();
        $emp2->nombreempresa = "Walmart";
        $emp2->nombrecompleto = "Luis Anguiano";
        $emp2->email = "gerente@gmail.com";
        $emp2->password = bcrypt('password12345');
        $emp2->rol_id = 2;
        $emp2->save();

        $emp3 = new User();
        $emp3->nombreempresa = "Soriana";
        $emp3->nombrecompleto = "Leslie Hernandez";
        $emp3->email = "finanzas@gmail.com";
        $emp3->password = bcrypt('password12345');
        $emp3->rol_id = 3;
        $emp3->save();
    }
}
