<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            DB::table('companies')->insert([
                'name' => 'Empresa ' . $i,
                'description' => $faker->paragraph(1),
                'cnpj' => preg_replace('/\D/', '',  $faker->cnpj),
                'id_plan' => random_int(1, 2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
