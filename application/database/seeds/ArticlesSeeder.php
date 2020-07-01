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
        $article->name = "Massimo Dutti";
        $article->color = "white";
        $article->size = "s";
        $article->description = "Maximum est in amicitia parem esse inferiori. Saepe enim excellentiae quaedam sunt, qualis erat Scipionis in nostro, ut ita dicam, grege.";
        $article->price = 39.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Massimo Dutti";
        $article->color = "Black";
        $article->size = "s";
        $article->description = "Quare hoc quidem praeceptum, cuiuscumque est, ad tollendam amicitiam valet; illud potius praecipiendum fuit, ut eam diligentiam adhiberemus in amicitiis comparandis,";
        $article->price = 39.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Massimo Dutti";
        $article->color = "Black";
        $article->size = "l";
        $article->description = "Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum";
        $article->price = 39.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Massimo Dutti";
        $article->color = "black";
        $article->size = "xl";
        $article->description = "Orientis vero limes in longum protentus et rectum ab Euphratis fluminis ripis ad usque supercilia porrigitur Nili, laeva Saracenis conterminans gentibus,";
        $article->price = 39.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Lacoste";
        $article->color = "black";
        $article->size = "s";
        $article->description = "Cum haec taliaque sollicitas eius aures everberarent expositas semper eius modi rumoribus et patentes, varia animo tum miscente consilia, tandem id";
        $article->price = 119.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Lacoste";
        $article->color = "white";
        $article->size = "xl";
        $article->description = "Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut";
        $article->price = 119.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Lacoste";
        $article->color = "black";
        $article->size = "xl";
        $article->description = "Iamque lituis cladium concrepantibus internarum non celate ut antea turbidum saeviebat ingenium a veri consideratione detortum et nullo inpositorum";
        $article->price = 119.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Versace Jeans Couture";
        $article->color = "motif";
        $article->size = "s";
        $article->description = "Pompeio, qui tum erat consul, dissideret, quocum coniunctissime et amantissime vixerat, quanta esset hominum vel admiratio vel querella.";
        $article->price = 299.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Versace Jeans Couture";
        $article->color = "black";
        $article->size = "l";
        $article->description = "Utque proeliorum periti rectores primo catervas densas opponunt et fortes, deinde";
        $article->price = 299.99;
        $article->image = "mon image";
        $article->save();

        $article = new Article();
        $article->name = "Versace Jeans Couture";
        $article->color = "white";
        $article->size = "xl";
        $article->description = "Nihil est enim virtute amabilius, nihil quod magis adliciat ad diligendum, quippe";
        $article->price = 299.99;
        $article->image = "mon image";
        $article->save();
    }
}
