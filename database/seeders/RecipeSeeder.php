<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $recipes = [

            'перші страви' => [

                [
                    'name' => 'Український борщ',
                    'ingredients' => 'буряк, картопля, морква, капуста, свинина',
                    'description' => 'Класичний український борщ.'
                ],

                [
                    'name' => 'Курячий бульйон',
                    'ingredients' => 'курка, морква, цибуля, лавровий лист',
                    'description' => 'Легкий курячий суп.'
                ],

                [
                    'name' => 'Суп-пюре з гарбуза',
                    'ingredients' => 'гарбуз, вершки, цибуля',
                    'description' => 'Ніжний кремовий суп.'
                ],

                [
                    'name' => 'Солянка',
                    'ingredients' => 'копченості, огірки, лимон, маслини',
                    'description' => 'Густий мʼясний суп.'
                ],

                [
                    'name' => 'Грибний суп',
                    'ingredients' => 'печериці, картопля, морква',
                    'description' => 'Ароматний суп з грибами.'
                ],

            ],

            'другі страви' => [

                [
                    'name' => 'Котлети по-домашньому',
                    'ingredients' => 'фарш, цибуля, яйце',
                    'description' => 'Соковиті домашні котлети.'
                ],

                [
                    'name' => 'Плов',
                    'ingredients' => 'рис, яловичина, морква',
                    'description' => 'Ароматний узбецький плов.'
                ],

                [
                    'name' => 'Голубці',
                    'ingredients' => 'капуста, фарш, рис',
                    'description' => 'Традиційні голубці.'
                ],

                [
                    'name' => 'Курка в духовці',
                    'ingredients' => 'курка, часник, паприка',
                    'description' => 'Запечена курка з хрусткою скоринкою.'
                ],

                [
                    'name' => 'Вареники з картоплею',
                    'ingredients' => 'борошно, картопля, цибуля',
                    'description' => 'Класичні вареники.'
                ],

            ],

            'салати та закуски' => [

                [
                    'name' => 'Салат Олівʼє',
                    'ingredients' => 'картопля, яйця, ковбаса, огірки',
                    'description' => 'Популярний святковий салат.'
                ],

                [
                    'name' => 'Цезар з куркою',
                    'ingredients' => 'курка, салат, пармезан, сухарики',
                    'description' => 'Класичний салат Цезар.'
                ],

                [
                    'name' => 'Грецький салат',
                    'ingredients' => 'помідори, огірки, фета',
                    'description' => 'Середземноморський салат.'
                ],

                [
                    'name' => 'Крабовий салат',
                    'ingredients' => 'крабові палички, кукурудза, яйця',
                    'description' => 'Швидкий салат.'
                ],

                [
                    'name' => 'Салат з тунцем',
                    'ingredients' => 'тунець, яйця, зелень',
                    'description' => 'Легкий салат з тунцем.'
                ],

            ],

        ];

        foreach ($recipes as $categoryName => $categoryRecipes) {

            $category = Category::where('name', $categoryName)->first();

            foreach ($categoryRecipes as $recipe) {

                Recipe::create([
                    'user_id' => $users->random()->id,
                    'category_id' => $category->id,
                    'name' => $recipe['name'],
                    'ingredients' => $recipe['ingredients'],
                    'description' => $recipe['description'],
                    'image' => null,
                ]);

            }

        }
    }
}
