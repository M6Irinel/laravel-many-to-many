<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $f)
    {
        for ($i=0; $i < 10; $i++) { 
            $n = new Post();
            $n->title = $f->unique()->words( rand(5, 10), true );
            $n->description = $f->paragraph( rand(10, 20), true );
            $n->slug = str_replace(' ', '-', $n->title);

            $n->save();
        }
    }
}
