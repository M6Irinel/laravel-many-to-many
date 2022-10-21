<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Food', 'Film', 'Sport', 'Exploration'];

        foreach ($categories as $name) {
            $c = new Category();
            $c->name = $name;
            $c->save();
        }
    }
}
