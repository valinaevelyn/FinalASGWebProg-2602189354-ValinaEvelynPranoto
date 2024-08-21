<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            Avatar::create([
                'name' => 'Avatar ' . $i,
                'image' => 'profile_image/avatar-' . $i . '.jpg',
                'price' => mt_rand(50, 100000)
            ]);
        }
    }
}
