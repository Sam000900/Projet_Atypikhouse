<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Seed the application's database with articles bind to the user with the id 1.
     */
    public function run(): void
    {
        $user = User::where('email', 'sam.gar@test.com')->first();

        Article::factory()->create([
            'name' => "Séjour insolite : Découvrez les plus beaux hébergements pour une expérience unique",
            'text' => "Vous rêvez d'une escapade hors du commun, loin du quotidien et en pleine nature ? Découvrez les hébergements insolites qui vous promettent un séjour unique, entre cabanes perchées, bulles sous les étoiles et lodges en bord de mer.",
            'conclusion' => "Que vous soyez à la recherche d'un séjour romantique, d'une aventure en pleine nature ou d'un moment de détente absolue, les hébergements insolites sont faits pour vous. Prêt à tenter l'expérience ? Réservez dès maintenant et vivez un séjour hors du commun !",
            'image_path' => "images/seeder-images/article-image-1.jpg",
            'user_id' => $user->id,
        ]);

        Article::factory()->create([
            'name' => "Article 2",
            'text' => "Texte de l'article 2",
            'conclusion' => "Conclusion de l'article 2",
            'image_path' => "images/seeder-images/article-image-2.jpg",
            'user_id' => $user->id,
        ]);

        Article::factory()->create([
            'name' => "Article 3",
            'text' => "Texte de l'article 3",
            'conclusion' => "Conclusion de l'article 3",
            'image_path' => "images/seeder-images/article-image-3.jpg",
            'user_id' => $user->id,
        ]);

        Article::factory()->create([
            'name' => "Article 4",
            'text' => "Texte de l'article 4",
            'conclusion' => "Conclusion de l'article 4",
            'image_path' => "images/seeder-images/article-image-4.jpg",
            'user_id' => $user->id,
        ]);

        Article::factory()->create([
            'name' => "Article 5",
            'text' => "Texte de l'article 5",
            'conclusion' => "Conclusion de l'article 5",
            'image_path' => "images/seeder-images/article-image-5.jpg",
            'user_id' => $user->id,
        ]);

        Article::factory()->create([
            'name' => "Article 6",
            'text' => "Texte de l'article 6",
            'conclusion' => "Conclusion de l'article 6",
            'image_path' => "images/seeder-images/article-image-6.jpg",
            'user_id' => $user->id,
        ]);
    }
}
