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
        /* User::factory(10)->create();

        $users = User::all();
        foreach ($users as $user) {
            $user->activities()->attach([
                rand(1, 6),
                rand(7, 11)
            ]);
        } */
    }
}
