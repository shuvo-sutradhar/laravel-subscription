<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name' => 'basic',
            'api_id' => 'price_1GrL5kL8CssX6geG9YoYKJvv',
            'description' => 'The basic plan allows to create 1 course with unlimited students'
        ]);

        DB::table('plans')->insert([
            'name' => 'plus',
            'api_id' => 'price_1GrNivL8CssX6geGqlZSmqbH',
            'description' => 'The plus plan allows to create 1 course with unlimited students'
        ]);

        DB::table('plans')->insert([
            'name' => 'pro',
            'api_id' => 'price_1GrSpUL8CssX6geGvENWwrNk',
            'description' => 'The plus pro allows to create up to 10 course with unlimited students'
        ]);
    }
}
