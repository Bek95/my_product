<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = new Article();
        $article->name = "massimo dutti";
        $article->color = "white";
        $article->size = "s";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 39.99;
        $article->save();

        $article = new Article();
        $article->name = "massimo dutti";
        $article->color = "Black";
        $article->size = "s";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 39.99;
        $article->save();

        $article = new Article();
        $article->name = "massimo dutti";
        $article->color = "Black";
        $article->size = "l";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 39.99;
        $article->save();

        $article = new Article();
        $article->name = "massimo dutti";
        $article->color = "black";
        $article->size = "xl";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 39.99;
        $article->save();

        $article = new Article();
        $article->name = "Lacoste";
        $article->color = "black";
        $article->size = "s";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 119.99;
        $article->save();

        $article = new Article();
        $article->name = "Lacoste";
        $article->color = "white";
        $article->size = "xl";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 119.99;
        $article->save();

        $article = new Article();
        $article->name = "Lacoste";
        $article->color = "black";
        $article->size = "xl";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 119.99;
        $article->save();

        $article = new Article();
        $article->name = "Versace Jeans Couture";
        $article->color = "motif";
        $article->size = "s";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 299.99;
        $article->save();

        $article = new Article();
        $article->name = "Versace Jeans Couture";
        $article->color = "black";
        $article->size = "l";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 299.99;
        $article->save();

        $article = new Article();
        $article->name = "Versace Jeans Couture";
        $article->color = "white";
        $article->size = "xl";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 299.99;
        $article->save();
    }
}
