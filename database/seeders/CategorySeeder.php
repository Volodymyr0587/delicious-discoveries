<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

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
            'напої',
            'сніданки',
            'соуси та заправки',
            'гарніри',
            'паста та макарони',
            'гриль та барбекю',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
