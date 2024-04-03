<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Manuel Lisandro',
            'surname' => 'Dardón López',
            'email' => 'mdardon@colegiodeinfantes.edu.gt',
            'password' => 'Alejandro31$',
        ]);
        User::create([
            'name' => 'Oscar Adolfo',
            'surname' => 'Orozco y Orozco',
            'email' => 'administracion@colegiodeinfantes.edu.gt',
            'password' => '123456',
        ]);
        User::create([
            'name' => 'Edson Alejandro',
            'surname' => 'Cuéllar Cabrera',
            'email' => 'eacuellarc@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Juan Carlos',
            'surname' => 'Bran Morales',
            'email' => 'jcbranm@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Edmundo Miguel',
            'surname' => 'Foronda Morales',
            'email' => 'emforondam@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Ingrid Verónica',
            'surname' => 'Morales',
            'email' => 'preprimaria@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Sonia Maricela',
            'surname' => 'Hernandez Galindo',
            'email' => 'primaria@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Pamela Fabiola',
            'surname' => 'Hernández Tejeda',
            'email' => 'basicos@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Ricardo',
            'surname' => 'Ortiz Romero',
            'email' => 'diversificado@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Martina',
            'surname' => 'Macario Xaper',
            'email' => 'mmacariox@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Ulices Geovanny',
            'surname' => 'Castellanos Méndez',
            'email' => 'ugcastellanosm@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Mynor Vinicio',
            'surname' => 'Santizo Rosales',
            'email' => 'mvsantizor@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Hugo Javier',
            'surname' => 'Castañeda Toca',
            'email' => 'hjcastanedat@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Carlos Antonio',
            'surname' => 'Carrillo Mejía',
            'email' => 'ccarrillo@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Carlos Humberto',
            'surname' => 'Polanco Flores',
            'email' => 'chpolancof@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Mario René',
            'surname' => 'Segura Pastrana',
            'email' => 'mrsegurap@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
        User::create([
            'name' => 'Jaime Armando',
            'surname' => 'Díaz',
            'email' => 'jadiaz@colegiodeinfantes.edu.gt',
            'password' => 'Infantes24',
        ]);
    }
}
