<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'classique';
        $category->save();

        $category = new Category();
        $category->name = 'casual';
        $category->save();

        $category = new Category();
        $category->name = 'manches courtes';
        $category->save();

        $category = new Category();
        $category->name = 'manches longues';
        $category->save();
    }
}
