<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'перші страви',
            'другі страви',
            'салати та закуски',
            'випічка',
            'торти',
            'десерти',
            'напої'
        ];

        foreach ($categories as $category) {
            Category::create(['category_name' => $category]);
        }
    }
}
