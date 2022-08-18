<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Post::factory(50)->create();

        User::create([
            'name' => 'Kiigeeks',
            'username' => 'kiigeeks',
            'email' => 'test@gmail.com',
            'password' => bcrypt('12345')
        ]);

        Category::create([
            'nama' => 'Sport',
            'slug' => 'sport'
        ]);

        Category::create([
            'nama' => 'Food',
            'slug' => 'food'
        ]);

        Category::create([
            'nama' => 'Travel',
            'slug' => 'travel'
        ]);
    }
}
