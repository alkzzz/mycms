<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory('cms\Role', 'admin')->create();
      factory('cms\Role', 'dosen')->create();
      factory('cms\User', 'admin')->create();
      factory('cms\User', 'dosen')->create();
	    factory('cms\User', 'user', 10)->create();
    }
}
