<?php

use Illuminate\Database\Seeder;

class TopMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('cms\TopMenu', 4)->create();
    }
}
