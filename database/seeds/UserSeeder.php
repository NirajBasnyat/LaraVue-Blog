<?php

use App\User;
use App\Like;
use App\Reply;
use App\Question;
use App\Category;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Category::class, 5)->create();
        factory(Question::class, 5)->create();
        factory(Reply::class, 50)->create()->each(function ($reply) {
            $reply->likes()->save(factory(Like::class)->make());
        });
    }
}
