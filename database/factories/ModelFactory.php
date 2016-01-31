<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->defineAs(cms\Role::class, 'admin', function (Faker\Generator $faker) {
    return [
        'name' => 'administrator',
        'display_name' => 'Administrator',
        'description' => 'Admin Utama Website',
    ];
});

$factory->defineAs(cms\Role::class, 'dosen', function (Faker\Generator $faker) {
    return [
        'name' => 'dosen',
        'display_name' => 'Dosen',
        'description' => 'Pengguna Dosen',
    ];
});

$factory->defineAs(cms\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'username' => 'admin',
        'email' => 'admin@localhost.com',
        'password' => bcrypt('admin'),
    ];
});

$factory->defineAs(cms\User::class, 'dosen', function (Faker\Generator $faker) {
    return [
        'username' => 'alkzzz',
        'email' => 'alkzzz@localhost.com',
        'password' => bcrypt('rahasia'),
    ];
});

$factory->defineAs(cms\User::class, 'user', function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(lcfirst($faker->unique()->domainWord)),
    ];
});

$factory->defineAs(cms\Category::class, 'menu', function (Faker\Generator $faker) {
    return [
      'title_id' => 'Menu',
      'slug_id' => 'menu',
      'title_en' => 'Menu',
      'slug_en' => 'menu',
    ];
});

$factory->define(cms\Category::class, function (Faker\Generator $faker) {
    return [
      'title_id' => $faker->firstNameMale ,
      'slug_id' => str_slug($faker->firstNameMale),
      'title_en' => $faker->firstNameFemale,
      'slug_en' => str_slug($faker->firstNameFemale),
    ];
});

$factory->define(cms\Slider::class, function (Faker\Generator $faker) {
    return [
    	'urutan_slider' => $faker->unique()->numberBetween($min = 1, $max = 50),
      'gambar' => $faker->imageUrl($width = 1200, $height = 500),
    ];
});

$factory->defineAs(cms\Post::class, 'article', function (Faker\Generator $faker) {
    return [
        'id_kategori' => $faker->numberBetween($min = 1, $max = 5),
        'title_id' => $faker->ColorName,
        'featured' => $faker->randomElement(array(true, false)),
        'slug_id' => lcfirst($faker->unique()->domainWord),
        'content_id' => $faker->paragraph,
        'title_en' => $faker->ColorName,
        'slug_en' => lcfirst($faker->unique()->domainWord),
        'content_en' => $faker->paragraph,
        'id_gambar' => factory(cms\Slider::class)->create()->id,
        'post_type' => 'article',
        'has_child'=> false,
        'post_parent' => 0,
    ];
});

$factory->defineAs(cms\Post::class, 'singlemenu', function (Faker\Generator $faker) {
    return [
    	'urutan' => 1,
        'title_id' => $faker->country,
        'slug_id' => lcfirst($faker->unique()->domainWord),
        'content_id' => $faker->paragraph,
        'title_en' => $faker->country,
        'slug_en' => lcfirst($faker->unique()->domainWord),
        'content_en' => $faker->paragraph,
        'post_type' => 'page',
        'has_child'=> false,
        'post_parent' => 0,
    ];
});

$factory->defineAs(cms\Post::class, 'menu', function (Faker\Generator $faker) {
    return [
    	'urutan' => $faker->unique()->numberBetween($min = 2, $max = 10),
        'title_id' => $faker->country,
        'slug_id' => lcfirst($faker->unique()->domainWord),
        'title_en' => $faker->country,
        'slug_en' => lcfirst($faker->unique()->domainWord),
        'post_type' => 'page',
        'has_child'=> true,
        'post_parent' => 0,
    ];
});

$factory->defineAs(cms\Post::class, 'submenu', function (Faker\Generator $faker) {
    return [
    	'urutan' => $faker->unique()->numberBetween($min = 1, $max = 20),
        'title_id' => $faker->country,
        'slug_id' => lcfirst($faker->unique()->domainWord),
        'content_id' => $faker->paragraph,
        'title_en' => $faker->country,
        'slug_en' => lcfirst($faker->unique()->domainWord),
        'content_en' => $faker->paragraph,
        'post_type' => 'page',
        'has_child' => false,
        'post_parent' => $faker->numberBetween(2, 5),
    ];
});

$factory->define(cms\TopMenu::class, function (Faker\Generator $faker) {
    return [
    	'urutan' => $faker->unique()->numberBetween($min = 1, $max = 20),
      'nama_topmenu' => $faker->country,
      'link_topmenu' => $faker->randomElement($array = array ('http://www.google.com','http://www.facebook.com','http://www.twitter.com','http://www.youtube.com')),
    ];
});
