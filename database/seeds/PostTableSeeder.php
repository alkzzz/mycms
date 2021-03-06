<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('cms\Slider', 'no_pic', 1)->create();
        factory('cms\Post', 'singlemenu')->create();
        factory('cms\Post', 'menu', 4)->create();
        factory('cms\Post', 'submenu', 10)->create();
        factory('cms\Post', 'article', 10)->create();
    }
}
