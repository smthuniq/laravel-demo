<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'email' => Str::random(10) . '@secret.net',
                'password' => Hash::make(Str::random(10)),
            ],
            [
                'name' => 'Danielle',
                'email' => Str::random(10) . '@secret.net',
                'password' => Hash::make(Str::random(10)),
            ],
            [
                'name' => 'Daniel',
                'email' => Str::random(10) . '@secret.net',
                'password' => Hash::make(Str::random(10)),
            ],
        ];
        DB::table('users')->insert($inserts);
    }
}
