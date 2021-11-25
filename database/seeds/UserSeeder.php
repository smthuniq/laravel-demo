<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = [
            [
                'name' => 'Irene',
                'password' => Hash::make(Str::random(10)),
            ],
            [
                'name' => 'Danielle',
                'password' => Hash::make(Str::random(10)),
            ],
            [
                'name' => 'Daniel',
                'password' => Hash::make(Str::random(10)),
            ],
        ];
        DB::table('users')->insert($inserts);
    }
}
