<?php

namespace Database\Seeders;
use App\Models\Post;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'title' => 'First Post',
            'content' => 'This is the first test post',
            'image' => null
        ]);

        Post::create([
            'title' => 'Second Post',
            'content' => 'Another test post',
            'image' => null
        ]);
    }
}
