<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
                'user_id' => 1,
                'content' => 'Hello!',
            ],
            [
                'user_id' => 1,
                'content' => 'It\'s warm.',
            ],
            [
                'user_id' => 2,
                'content' => 'Good morning.',
            ],
            [
                'user_id' => 3,
                'content' => 'Have a nice day!',
            ],
        ];
        DB::table('comments')->insert($inserts);
    }
}
