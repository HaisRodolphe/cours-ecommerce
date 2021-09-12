# cours-ecommerce
<h1>Heading</h1>

<h2>Sub-heading</h2>

<p>Paragraphs are separated
by a blank line.</p>

<p>Liste des commandes lier aux bundel.<br />
php bin/console</p>
Creating Symfony Applications
1-symfony new my_project_name --version=5.0
-------------------------------------------
2-composer require doctrine/annotations
https://symfony.com/doc/current/routing.html
Creating Routes as Attributes or Annotations
Création d'itinéraires en tant qu'attributs ou annotations

/**
 * @Route("/blog", name="blog_list")
 */

-------------------------------------------
3-composer require symfony/asset
https://symfony.com/doc/current/components/asset.html



-------------------------------------------
4-composer require symfony/http-foundation
https://symfony.com/doc/current/components/http_foundation.html


-------------------------------------------
5-composer require symfony/flex
https://symfony.com/doc/current/setup/flex.html

-------------------------------------------
A la découverte de Twig !
6-composer require twig/extra-bundle
https://packagist.org/packages/twig/extra-bundle
Appel des elements de la bdd avec twig
Exemple:
    {% for p in products %}
			<div class="col">
				<div class="card">
					<img src="{{ p.mainPicture }}" class="img-fluid" alt="Image du produit">
					<div class="card-body">
						<h4 class="card-title">{{ p.name }}
							({{ p.price / 100 }}
							&euro;)</h4>

						<span class="badge badge-info bg-dark">
							{{ p.category.name }}
						</span>

						<a href="#" class="btn btn-succes btn-sm">Stock:
							{{ p.stock }}</a>

						<p class="card-text">{{ p.shortDescription }}</p>
						<a href="#" class="btn btn-primery btn-sm">
							Dètails</a>
						<a href="#" class="btn btn-succes btn-sm">Ajouté</a>

					</div>
				</div>
			</div>
		{% endfor %}

-------------------------------------------
Doctrine et les bases de données

Doctrine est un ORM (M=maping), c'est une librairie, elle fait la corespondance entre le monde des (objets) et le monde relationnel de la base de donnée (mysql). Le travaille ne se fait plus que dans symfony, l'ORM gére tout se qui à était créer dans symfony aucune requette sql à faire.
3 notion esentielles avec Doctrine
-Les entites, représent les lignes de la table des produits.
-Le manager, qui permet de manipulet les ligne dans la table, suprimé, ajouter, modifier.
-Les repository, qui permet de faire selection, des remontées des enregistrement de la base de donner, directement sur le projet sous la forme dobjet des entitées créer.

->Avoir la liste des commande de doctrine
  php bin/console doctrine
7-composer require doctrine
https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/index.html
https://symfony.com/doc/current/doctrine.html
7-1-php bin/console doctrine:database:create ou d:d:c
https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/index.html
https://symfony.com/doc/current/doctrine.html 

Créer une entité Product et la migration qui va avec
7-2-composer require maker

Création d'une entity
7-3-php bin/console make:entity

Création du fichier de migration
7-3-1-php bin/console make:migration

Migration du fichier version dans la base de donnée
https://symfony.com/doc/3.1/bundles/DoctrineMigrationsBundle/index.html
7-3-2-php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:migrate --help

Modification d'une entity déjà existante appelé "exp:Product"
7-5-php bin/console make:entity Product

Controle du repository
7-6-php bin/console debug:autowiring --all repository

-------------------------------------------

Creation de fixtures, des fausse donner pour simulet un projet.
Documentation officielle du Doctrine Fixtures Bundle : 
https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
Créer des jeux de fausses données avec les Fixtures.
8-Composer require orm-fixtures
Creatrion de Dossier DataFixtures dans le quel se trouver le fichier AppFixtures.php qui vas permetre de creer le jeux de fausse donner.
Injection des fixtures dans la base de donnée.
8-1 php bin/console doctrine:fixtures:load

Autre bibliothéque de fixture "Faker".
Documentation du package Faker : https://github.com/fzaninotto/Faker
Dans les sections et chapitres suivants, je vais vous parler de Faker, une librairie PHP qui sert à créer de fausses données.
8-2 composer require --dev fakerphp/faker

Cette bibliothéque génère des prix cohérent pour les fausses données
https://packagist.org/packages/liorchamla/faker-prices
8-3 composer require liorchamla/faker-prices

https://packagist.org/packages/mbezhanov/faker-provider-collection
8-4 composer require mbezhanov/faker-provider-collection

https://symfony.com/doc/current/components/string.html
Pour la création des slugs.
8-5 composer require string
<?php

namespace App\DataFixtures;

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
      $product->setName($faker->productName)
          //strtolower conversion en minuscule
          ->setSlug(strtolower($this->slugger->slug($product->getName())))
    }
    // Le flush se fait qu'une seul fois pour les 100 données
    $manager->flush();
}    

Pour integrer des images dans le projet.
8-6 composer require bluemmb/faker-picsum-photos-provider
$faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
Injection d'image de 400*400
Le parammétre True permet de donner des images compris entre (0..1084)
->setMainPicture($faker->imageUrl(400, 400, true));
-------------------------------------------
Créer une association entre Product et Category
Création d'une entity
9- php bin/console make:entity Category
 >products
 >relation
 choix de la classe à relier ?
 >product
 Quel relation souhaite tu ?
>OneToMany
->la relation ManyToOne 
Chaque Cathegory à un seul product.
Mais chaque product peu avoir plusieur Category

->la relation OneToMany
Chaque Cathegory à plusieur product.
Mais chaque product peu avoir qu'une seul Category.

->Relation Many-To-Many
Chaque Cathegory à plusieur product.
Mais chaque product peu avoir plusieur Category.

->Relation One-To-One
Chaque Cathegory à un product.
Mais chaque product peu avoir qu'une Category.

 -Nouveau chant dans Product [category]
 >category

-L'option pourra etre Null.
>yes
-------------------------------------------
