<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use Liior\Faker\Prices;
use App\Entity\Category;
use Bezhanov\Faker\Provider\Commerce;
use Bluemmb\Faker\PicsumPhotosProvider;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager)
    {
        //Appel de faker objet
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        //Creation de 3 category avec trois nom au hasart.
        for ($c = 0; $c < 3; $c++) {
            $category = new Category;
            $category->setName($faker->department)
                ->setSlug(strtolower($this->slugger->slug($category->getName())));

            $manager->persist($category);

            //creer une boucle.
            for ($p = 0; $p < mt_rand(15, 20); $p++) {
                //integration des données à créer.
                $product = new Product;
                $product->setName($faker->productName)
                    ->setPrice($faker->price(4000, 20000))
                    //strtolower conversion en majuscule
                    ->setSlug(strtolower($this->slugger->slug($product->getName())))
                    ->setStock(mt_rand(0, 10))
                    ->setCategory($category)
                    ->setShortDescription($faker->paragraph())
                    ->setMainPicture($faker->imageUrl(400, 400, true));
                // je persit 100 produit
                $manager->persist($product);
            }
        }


        // Le flush se fait qu'une seul fois pour les 100 données
        $manager->flush();
    }
}
