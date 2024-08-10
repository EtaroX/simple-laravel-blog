<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws RandomException
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Loggable user',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        Post::factory()->count(5)->for($user)->create();

        for ($i = 0; $i < 5; $i++) {
            $user = User::factory()->create();
            for ($j = 0; $j < random_int(3,10); $j++) {
                Post::factory()->hasLikes()->for($user)->create();
            }
        }
    }
}
