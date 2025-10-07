<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Iconic cities',
                'slug' => 'iconic-cities',
                'icon' => 'fas fa-city',
                'description' => 'Stay in the world\'s most iconic cities',
                'sort_order' => 1
            ],
            [
                'name' => 'Beach',
                'slug' => 'beach',
                'icon' => 'fas fa-umbrella-beach',
                'description' => 'Beautiful beachfront properties',
                'sort_order' => 2
            ],
            [
                'name' => 'Mountains',
                'slug' => 'mountains',
                'icon' => 'fas fa-mountain',
                'description' => 'Mountain retreats and cabins',
                'sort_order' => 3
            ],
            [
                'name' => 'Cabins',
                'slug' => 'cabins',
                'icon' => 'fas fa-tree',
                'description' => 'Cozy cabins in nature',
                'sort_order' => 4
            ],
            [
                'name' => 'Amazing pools',
                'slug' => 'amazing-pools',
                'icon' => 'fas fa-swimming-pool',
                'description' => 'Properties with stunning pools',
                'sort_order' => 5
            ],
            [
                'name' => 'Trending',
                'slug' => 'trending',
                'icon' => 'fas fa-fire',
                'description' => 'Hot and trending destinations',
                'sort_order' => 6
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'icon' => 'fas fa-palette',
                'description' => 'Architecturally stunning homes',
                'sort_order' => 7
            ],
            [
                'name' => 'Countryside',
                'slug' => 'countryside',
                'icon' => 'fas fa-leaf',
                'description' => 'Rural escapes and farm stays',
                'sort_order' => 8
            ],
            [
                'name' => 'Lakefront',
                'slug' => 'lakefront',
                'icon' => 'fas fa-water',
                'description' => 'Properties by beautiful lakes',
                'sort_order' => 9
            ],
            [
                'name' => 'Skiing',
                'slug' => 'skiing',
                'icon' => 'fas fa-skiing',
                'description' => 'Ski-in ski-out properties',
                'sort_order' => 10
            ],
            [
                'name' => 'Vineyards',
                'slug' => 'vineyards',
                'icon' => 'fas fa-wine-glass',
                'description' => 'Stay among the vines',
                'sort_order' => 11
            ],
            [
                'name' => 'Castles',
                'slug' => 'castles',
                'icon' => 'fas fa-chess-rook',
                'description' => 'Historic castles and estates',
                'sort_order' => 12
            ],
            [
                'name' => 'Tiny homes',
                'slug' => 'tiny-homes',
                'icon' => 'fas fa-home',
                'description' => 'Compact and efficient living',
                'sort_order' => 13
            ],
            [
                'name' => 'Luxury',
                'slug' => 'luxury',
                'icon' => 'fas fa-gem',
                'description' => 'High-end luxury accommodations',
                'sort_order' => 14
            ],
            [
                'name' => 'Farms',
                'slug' => 'farms',
                'icon' => 'fas fa-tractor',
                'description' => 'Experience farm life',
                'sort_order' => 15
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}