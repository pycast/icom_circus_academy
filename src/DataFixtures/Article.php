<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article as EntityArticle;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Article extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 25; $i++) {
            $article = new EntityArticle();
            $article->setTitre($faker->words(3, true))
                ->setSlug($faker->slug)
                ->setContenu($faker->sentences(3, true))
                ->setAuteur($faker->lastName)
                ->setDate($faker->dateTime)
                ->setIllustration('6a926a5bf5a8c9497ae31b257d2a1611fbf9526f.jpg');
            $manager->persist($article);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
