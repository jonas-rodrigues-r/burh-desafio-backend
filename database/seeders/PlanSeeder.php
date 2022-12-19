<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        DB::table('plans')->insert([
            'name' => 'free',
            'description' => 'Plano Gratuito',
            'price' => 0.0,
            'number_vacancies' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('plans')->insert([
            'name' => 'premium',
            'description' => 'Plano Pago',
            'price' => 300.0,
            'number_vacancies' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
