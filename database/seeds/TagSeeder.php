<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ts = (new Tag())->ts;

        foreach ($ts as $t) {
            $n = new Tag();
            $n->name = $t;
            $n->slug = Str::slug($t);
            $n->save();
        }
    }
}
