<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Post;
use App\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $f)
    {
        $category_ids = Category::all()->pluck('id');

        for ($i=0; $i < 50; $i++) { 
            $n = new Post();

            $n->title = $f->words( rand(5, 10), true );
            $n->description = $f->paragraph( rand(10, 20), true );
            $n->slug = Str::slug($n->title);
            $n->category_id = $f->optional()->randomElement($category_ids);

            $n->save();
        }
    }
}
