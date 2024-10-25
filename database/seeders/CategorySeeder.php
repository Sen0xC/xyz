<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Track;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Soul',
            'Ambient',
            'Pop',
            'Rap',
            'Funk',
            'Rock',
            'Reggae / Dub',
            'Techno',
            'Electro'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // Get all tracks without a category
        $tracksWithoutCategory = Track::whereNull('category_id')->get();

        // Get all categories
        $categories = Category::all();

        foreach ($tracksWithoutCategory as $track) {
            // Assign a random category
            $randomCategory = $categories->random();
            $track->category()->associate($randomCategory);
            $track->save();
        }
    }
}
