<?php
/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/2/4
 * Time: 18:26
 */
use Faker\Generator as Faker;

$factory->define(App\Http\Controllers\PermissionsDemo\Post::class, function (Faker $faker) {
    return [
        'user_id'=>factory(\App\User::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});