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
        Avatar::create([
            'name' => 'Avatar ' . '1',
            'image' => 'profile_image/avatar-' . '1' . '.jpg',
            'price' => 50
        ]);

        for ($i = 2; $i <= 8; $i++) {
            Avatar::create([
                'name' => 'Avatar ' . $i,
                'image' => 'profile_image/avatar-' . $i . '.jpg',
                'price' => mt_rand(50, 100000)
            ]);
        }

        Avatar::create([
            'name' => 'Avatar ' . '9',
            'image' => 'profile_image/avatar-' . '9' . '.jpg',
            'price' => 100000
        ]);
    }
}
