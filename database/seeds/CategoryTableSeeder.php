<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory('cms\Category', 'menu', 1)->create();
          factory('cms\Category', 5)->create();
    }
}
