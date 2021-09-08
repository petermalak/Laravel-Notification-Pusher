<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'Post 1 Title',
            'content' => 'This is post 1 content',
            'user_id' => 1,
        ]);
      
        DB::table('posts')->insert([
              'title' => 'Post 2 Title',
              'content' => 'This is post 2 content',
              'user_id' => 2,
          ]);

    }
}
