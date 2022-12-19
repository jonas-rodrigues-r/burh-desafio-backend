<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $types = ['clt', 'pj', 'estagio'];

        $names = ['Dev Júnior', 'Dev Pleno', 'Dev Sênior', 'Dev Estágiario'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('vacancies')->insert([
                'title' => $names[random_int(0, count($names)-1)],
                'description' => $faker->paragraph,
                'type' => $types[random_int(0, count($types)-1)],
                'wage' => random_int(1500, 3000),
                'hours' => random_int(1, 6),
                'id_company' => random_int(1, 10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
