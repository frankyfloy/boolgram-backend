<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use App\Http\Controllers\Api\PostController;

class PostsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        for ($i = 0 ; $i < 10; $i++) {
            $post = new Post();
            $post->user_id = 1;
            $post->title = $faker->title;
            $post->slug = PostController::generateSlug($post->title);
            $post->content = $faker->text;
            $post->image = 'https://source.unsplash.com/user/c_v_r/1600x900';
            $post->save();
        }
    }
}
