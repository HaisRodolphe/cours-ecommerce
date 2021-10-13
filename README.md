# cours-ecommerce
<h3>Symfony 5</h3>

<h2>3 Notions a connaitre</h2>
<h3>Les entités qui représente (les enregistrements).</h3>
<h3>Les Repositories qui font remonté (les selections des entitées)</h3>
<h3>Le Manager qui permet de manipuler des enregistrement dans notre base de donnée(en les supriments, les modifiers ou les ajoutées).
<h2>Le systhéme de migration</h2>
<p> qui permet de créer des script pour passée d'un etat de  actuel à l'etat ulterieur, permet d'ajouter ou d'annuler une migration.
<h2>Systhéme de fixtures</h2>
<p>Qui permet de créer de fausse données avec des bibliothéques Faker</p>

<h2>Doctrine qui permet de créer des associations (Relations) entre les entitées.</h2>
<p>Avec OneToMany, ManyToOne, ManyToMany et OneTOne. Si ont veux passé un produit dans une category 
 j'utilise $produit->setCategory($category). Dans twig si j'ai besoin de passée une category {{ product.category }}</P>
<h2>Github</h2>
<h3>git status</h3>
<h3>git add .</h3>
<h3>git commit -m "Mise en place de doctrine et de nos premieres entités"</h3>
https://symfony.com/bundles
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
Permet de trouvet les différent service dans symfony
-php bin/console debug:autowiring --all
Pour chercher les services de l'url exemple:
-php bin/console debug:autowiring --all url
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
Symfony 5 et le Debugger Pack
10- composer require debug
-------------------------------------------
<h2>Twig : aller plus loin</h2>
Voir :show.html.twig
Routes "statiques" : le problème des URLs écrites en dur.
*Dans un projet il faut evité d'ecrire les routes en dur {{ product.category.name }},
 {{ product.name }}il faut utilisé.
Génération des URLs avec l'UrlGenerator et la fonction path()
*Pour chercher les services de l'url exemple:
-php bin/console debug:autowiring --all url

Les classes et interfaces suivantes peuvent être utilisées comme indices de type lors du câblage automatique :
 (ne montrant que les classes/interfaces correspondant à l'URL)

Un service d'assistance pour manipuler les URL à l'intérieur et à l'extérieur de la portée de la demande.
-Symfony\Component\HttpFoundation\UrlHelper (url_helper)

UrlGeneratorInterface est l'interface que toutes les classes de générateur d'URL doivent implémenter.
-Symfony\Component\Routing\Generator\UrlGeneratorInterface (router.default)

UrlMatcherInterface est l'interface que toutes les classes de correspondance d'URL doivent implémenter.
-Symfony\Component\Routing\Matcher\UrlMatcherInterface (router.default)

Astuce de pro : utilisez des interfaces dans vos types-hints au lieu de classes pour bénéficier du principe d'inversion de dépendance.
-Dans notre cas nous allon utliser "UrlGeneratorInterface".
Pour atteindre la page home.html.twig.
<a href="{{ path('homepage') }}">Accueil</a>
-Dans category.html.twig pour afficher le detail du product sur le page show.html.twig.
Le resultat de la fonction 'path',comme premier paramétre, le nom de ma route 'product_show', 
en deuxieme paramétre un tableau assiociatif avec le différent paramétre de la route 'category_slug' le slug de la 
category : 'p.category.slug' et un paramétre slug qui prendra 'p.slug'.
<a href="{{ path('product_show', {'category_slug': p.category.slug, 'slug':p.slug } ) }}" class="btn btn-primery btn-sm">
Exemple UrlGeneratorInterface:
Dans le controller:
$url = $urlGenerator->generate('nom_de_la_route',[
	'param1 = 'valeur',
	'param2 = 'valeur',
])
Dans twig :
<a href="{{ path('nom_de_la _route', {
	'param1': 'valeur',
	'param2' : 'valeur'
})}}>
</a>

-------------------------------------------
<h1>Les formulaires dans Symfony 5</h1>

Documentation officielle de Symfony pour débuter avec les forms : 
https://symfony.com/doc/current/forms.html
Documentation officielle de Symfony sur le composant symfony/form : 
https://symfony.com/doc/current/components/form.html
Documentation officielle de Symfony - La liste des types de champs existants : 
https://symfony.com/doc/current/reference/forms/types.html
Installer le composant symfony/form
11- composer require form

Autowirable Types
-----------------
Les classes et interfaces suivantes peuvent être utilisées comme indices de type lors du câblage automatique :
(affichant uniquement le formulaire de correspondance des classes/interfaces form)

Permet de créer un formulaire basé sur un nom, une classe ou une propriété.
Symfony\Component\Form\FormFactoryInterface (form.factory)

Le registre central du composant Form.
Symfony\Component\Form\FormRegistryInterface (form.registry)

Crée des instances ResolvedFormTypeInterface.
Symfony\Component\Form\ResolvedFormTypeFactoryInterface (form.resolved_type_factory)
 
Formate les liens des fichiers de débogage.
Symfony\Component\HttpKernel\Debug\FileLinkFormatter (debug.file_link_formatter)

Astuce de pro : utilisez des interfaces dans vos types-hints au lieu de classes pour bénéficier 
du principe d'inversion de dépendance.

Dans notre projet nous allons utiliser FormFactoryInterface.
Creation d'un formulaire:
builder est un configurateur de formulaire
ProductController.php
/**
* @Route("/admin/product/create", name="product_create")
*/
public function create(FormFactoryInterface $factory): Response
{	
	
    $builder = $factory->createBuilder();

    $builder->add('name')
        ->add('shortDescription')
        ->add('price')
        ->add('category');

    $form = $builder->getForm();

    $formView = $form->createView();

    return $this->render('product/create.html.twig', [
        'formView' => $formView
    ]);
}
Affichage dans twig: create.html.twid

{% block body %}
	<h1>Nouveau produit</h1>
    Permet d'afficher un formulaire mais il n'est pas assez préssis.
	{{ form(formView) }}
{% endblock %}

Donc nous utilisons {{ form_row(formView.name) }} pour péciser le choix de l'affichage
{% block body %} Ouverture du bloc
	<h1>Nouveau produit</h1>
	{# {{ form(formView) }} #}
	{{ form_start(formView) }} Démarrage du formulaire

	{{ form_errors(formView) }}
	<div class="row">
		<div class="col">
			{{ form_row(formView.name) }} //Affichage du nom
			{{ form_row(formView.shortDescription) }} //Afichage de la description

		</div>
		<div class="col">
			{{ form_row(formView.category) }} //Affichage de la description
			{{ form_row(formView.price) }} //Affichage du prix

		</div>
	</div>
	<br>
	<button type="submit" class="btn btn-primery">
		<i class="fas fa-save"></i>
		Créer le produit
	</button>

	{{ form_end(formView) }} Fermeture du formulaire

{% endblock %} Fermeture du block

Twig : Les thèmes de formulaires livrés avec Symfony
Ne pas hesiter à utiliser des thémes déjà existant de symfony.
https://symfony.com/doc/current/form/form_themes.html
Que l'on se fait livré dans: twig.yaml
sous la forme suivant:
twig:
    default_path: '%kernel.project_dir%/templates'
    form_themes:
        - bootstrap_4_layout.html.twig

Explication d'une commande Forme: ProductController.php
https://127.0.0.1:8000/admin/product/create
->add('shortDescription', TextareaType::class, [
    'label' => 'Description courte',
    'attr' => [
    //'class' => 'form-control', //Il ne faut pas intégre la classe dans le controller.
    'placeholder' => 'Taper une description assez courte mais parlante pour le visiteur'
    ]
])

Soumission du formulaire et récupération des données:
ProductController.php

/**
* @Route("/admin/product/create", name="product_create")
*/
public function create(FormFactoryInterface $factory, Request $request): Response
{

    $builder = $factory->createBuilder();

    $builder->add('name', TextType::class, [
        'label' => 'Nom du produit',
        'attr' => ['placeholder' => 'taper le nom du produit']
    ])
    ->add('shortDescription', TextareaType::class, [
        'label' => 'Description courte',
        'attr' => [
            'placeholder' => 'Taper une description assez courte mais parlante pour le visiteur'
        ]
    ])
    ->add('price', MoneyType::class, [
        'label' => 'Prix du produit',
        'attr' => [
            'placeholder' => 'taper le prix du produit en €'
        ]
    ])
    ->add('category', EntityType::class, [
        'label' => 'catégorie',
        'placeholder' => '-- Choisir une catégorie --',
        'class' => Category::class,
        //'choice_label' => 'name'
        //choice_label peu aussi retourner un function.
        'choice_label' => function (Category $category) {
            return strtoupper($category->getName());
        }
    ]);

    $form = $builder->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted()) {
        $data = $form->getData();

        $product = new Product;
        $product->setName($data['name'])
            ->setShortDescription($data['shortDescription'])
            ->setPrice($data['price'])
            ->setCategory($data['category']);
    }

    $formView = $form->createView();

    return $this->render('product/create.html.twig', [
        'formView' => $formView
    ]);
}

Récupérer les données sous la forme d'un objet précis (data_class)

class ProductController extends AbstractController
{
    /**
     * @Route("/{slug}", name="product_category")
     */
    public function category($slug, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneBy([
            'slug' => $slug
        ]);

        //Si la cathegory n'existe pas alors, il vas vers une erreur.
        if (!$category) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }

        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category,
        ]);
    }
    /**
     * @Route("/{category_slug}/{slug}", name="product_show")
     */
    public function show($slug, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneBy([
            'slug' => $slug
        ]);

        //Si le produit n'existe pas, alors il vas vers une erreur.
        if (!$product) {
            throw $this->createNotFoundException("Le produit demandé n'exite pas");
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/admin/product/create", name="product_create")
     */
    public function create(FormFactoryInterface $factory, Request $request): Response
    {

        $builder = $factory->createBuilder(FormType::class, null, [
            'data_class' => Product::class
        ]);

        $builder->add('name', TextType::class, [
            'label' => 'Nom du produit',
            'attr' => ['placeholder' => 'taper le nom du produit']
        ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Description courte',
                'attr' => [
                    'placeholder' => 'Taper une description assez courte mais parlante pour le visiteur'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'taper le prix du produit en €'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'catégorie',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                //'choice_label' => 'name'
                //choice_label peu aussi retourner un function.
                'choice_label' => function (Category $category) {
                    return strtoupper($category->getName());
                }
            ]);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $$product = $form->getData();

            // $product = new Product;
            // $product->setName($data['name'])
            //     ->setShortDescription($data['shortDescription'])
            //     ->setPrice($data['price'])
            //     ->setCategory($data['category']);
        }

        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView
        ]);
    }
}

Faire persister une entité issue d'un formulaire:
class ProductController extends AbstractController
{
    /**
     * @Route("/{slug}", name="product_category")
     */
    public function category($slug, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneBy([
            'slug' => $slug
        ]);

        //Si la cathegory n'existe pas alors, il vas vers une erreur.
        if (!$category) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }

        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category,
        ]);
    }
    /**
     * @Route("/{category_slug}/{slug}", name="product_show")
     */
    public function show($slug, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneBy([
            'slug' => $slug
        ]);

        //Si le produit n'existe pas, alors il vas vers une erreur.
        if (!$product) {
            throw $this->createNotFoundException("Le produit demandé n'exite pas");
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/admin/product/create", name="product_create")
     */
    public function create(FormFactoryInterface $factory, Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {

        $builder = $factory->createBuilder(FormType::class, null, [
            'data_class' => Product::class
        ]);

        $builder->add('name', TextType::class, [
            'label' => 'Nom du produit',
            'attr' => ['placeholder' => 'taper le nom du produit']
        ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Description courte',
                'attr' => [
                    'placeholder' => 'Taper une description assez courte mais parlante pour le visiteur'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'taper le prix du produit en €'
                ]
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'image du produit',
                'attr' => ['placeholder' => 'Tapez une URL d\'image !']
            ])
            ->add('category', EntityType::class, [
                'label' => 'catégorie',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                //'choice_label' => 'name'
                //choice_label peu aussi retourner un function.
                'choice_label' => function (Category $category) {
                    return strtoupper($category->getName());
                }
            ]);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $product = $form->getData();
            $product->setSlug(strtolower($slugger->slug($product->getName())));
            //persiter l'information
            $em->persist($product);
            $em->flush();

            //dd($product);
        }

        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView
        ]);
    }
}

👌 Créer une classe de formulaire
Utilisation de la console form.

php bin/console make:form ProductType

The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > Product

 Creation de Form/ProductType.php

 <?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['placeholder' => 'taper le nom du produit']
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Description courte',
                'attr' => [
                    'placeholder' => 'Taper une description assez courte mais parlante pour le visiteur'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'taper le prix du produit en €'
                ]
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'image du produit',
                'attr' => ['placeholder' => 'Tapez une URL d\'image !']
            ])
            ->add('category', EntityType::class, [
                'label' => 'catégorie',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                //'choice_label' => 'name'
                //choice_label peu aussi retourner un function.
                'choice_label' => function (Category $category) {
                    return strtoupper($category->getName());
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

On deplace tout l'argumentation de Form créer sur ProductController.
Mais dans le Controller.php nous changeons l'accés de $builder.
ProductType.php
	/**
     * @Route("/admin/product/create", name="product_create")
     */
    public function create(FormFactoryInterface $factory, Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {

        <h2>$builder = $factory->createBuilder(ProductType::class);</h2>

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $product = $form->getData();
            $product->setSlug(strtolower($slugger->slug($product->getName())));
            //persiter l'information
            $em->persist($product);
            $em->flush();

            //dd($product);
        }

        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView
        ]);
    }

Form : les raccourcis offerts par l'AbstractController

 -Créer un formulaire de modification 

 	/**
     * @Route("/admin/product/{id}/edit", name="product_edit")
     */
    public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em): Response
    {
        $product = $productRepository->find($id);
        //Rappeler $product revient au même que $form->setData($product);
        $form = $this->createForm(ProductType::class, $product);
        // Permet de rappeler les information du product $id
        //$form->setData($product);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            //dd($product);
        }

        $formView = $form->createView();

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/admin/product/create", name="product_create")
     */
    public function create(FormFactoryInterface $factory, Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {
        $product = new Product;

        $builder = $factory->createBuilder(ProductType::class, $product);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $product->setSlug(strtolower($slugger->slug($product->getName())));
            //persiter l'information
            $em->persist($product);
            $em->flush();

            //dd($product);
        }

        $formView = $form->createView();

        return $this->render('product/create.html.twig', [
            'formView' => $formView
        ]);
    }

-Twig de edit.html.twig

{% extends "base.html.twig" %}

{% block title %}
	Edition de
	{{ product.name }}
{% endblock %}

{% block body %}
	<h1>Editer le produit
		{{ product.name }}</h1>

	{{ form_start(formView) }}

	{{ form_errors(formView) }}
	<div class="row">
		<div class="col">
			{{ form_row(formView.name) }}
			{{ form_row(formView.shortDescription) }}

		</div>
		<div class="col">
			{{ form_row(formView.mainPicture) }}
			{{ form_row(formView.category) }}
			{{ form_row(formView.price) }}

		</div>
	</div>
	<br>
	<button type="submit" class="btn btn-primery">
		<i class="fas fa-save"></i>
		Créer le produit
	</button>

	{{ form_end(formView) }}
{% endblock %}

-Créer une Redirection après la soumission d'un formulaire

	/**
     * @Route("/admin/product/{id}/edit", name="product_edit")
     */
    public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): Response
    {
        $product = $productRepository->find($id);
        //Rappeler $product revient au même que $form->setData($product);
        $form = $this->createForm(ProductType::class, $product);
        // Permet de rappeler les information du product $id
        //$form->setData($product);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            //Creation d'une redirection aprés validation dans le detail.
            $response = new Response();
            $url = $urlGenerator->generate('product_show', [
                'category_slug' => $product->getCategory()->getSlug(),
                'slug' => $product->getSlug()
            ]);
            $response->headers->set('location', $url);
            $response->setStatusCode(302);

            return $response;
        }
-La redirection plus simplifier.
    /**
     * @Route("/admin/product/{id}/edit", name="product_edit")
     */
    public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): Response
    {
        $product = $productRepository->find($id);
        //Rappeler $product revient au même que $form->setData($product);
        $form = $this->createForm(ProductType::class, $product);
        // Permet de rappeler les information du product $id
        //$form->setData($product);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();
            //Creation d'une redirection aprés validation dans le detail.
            $url = $urlGenerator->generate('product_show', [
                'category_slug' => $product->getCategory()->getSlug(),
                'slug' => $product->getSlug()
            ]);

            // $response = new RedirectResponse($url);
            // return $response;
            return $this->redirect($url);
        }

        $formView = $form->createView();

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'formView' => $formView
        ]);
    }
	
Mais peu s'ecrire aussi un raccourci encore plus rapide.

	/**
     * @Route("/admin/product/{id}/edit", name="product_edit")
     */
    public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): Response
    {
        $product = $productRepository->find($id);
        //Rappeler $product revient au même que $form->setData($product);
        $form = $this->createForm(ProductType::class, $product);
        // Permet de rappeler les information du product $id
        //$form->setData($product);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();
            //Creation d'une redirection aprés validation dans le detail.
            return $this->redirectToRoute('product_show', [
                'category_slug' => $product->getCategory()->getSlug(),
                'slug' => $product->getSlug()
            ]);
        }

        $formView = $form->createView();

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'formView' => $formView
        ]);
    }

Exercice #01 : Créez un CategoryController avec deux Routes

Créez une classe CategoryController avec deux méthodes.
-php bin/console make:controller CategoryController

Exigences :
Une méthode routée sur /admin/category/create : elle doit juste afficher un fichier Twig avec un titre h1 avec le texte "Créer une catégorie"
Une méthode routée sur /admin/category/{id}/edit : elle doit afficher un fichier Twig avec un titre h1 contenant le nom de la catégorie correspondant à l'id envoyé dans l'URL

Exercice #02 : Créez le formulaire de création d'une catégorie
 Créez une classe de formulaire (make:form) qui s'appellera CategoryType qui ne contiendra qu'un seul champ "name"

Exigences :

La route /admin/category/create doit afficher le formulaire
On doit aussi gérer la soumission du formulaire avec enregistrement de la nouvelle catégorie dans la base de données !
On doit enfin rediriger le visiteur vers la page d'accueil

-----------------------------------
<h2>Aller plus loin avec le composant Form de Symfony (45 minutes)</h2>
Documentation officielle de Symfony sur les événements d'un Formulaire : 
https://symfony.com/doc/current/form/events.html
Documentation officielle de Symfony pour débuter avec les forms : 
https://symfony.com/doc/current/forms.html
Documentation officielle de Symfony sur le composant symfony/form : 
https://symfony.com/doc/current/components/form.html

<h3>Réagir aux événements lancés par le formulaire</h3>

<h3>Dans productType.php création d'un écouteur d'évenement</h3>

$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
    $form = $event->getForm();

    /** @var Product */
    $product = $event->getData();

    if($product->getId() === null) {
        $form->add('category', EntityType::class, [
            'label' => 'catégorie',
            'placeholder' => '-- Choisir une catégorie --',
            'class' => Category::class,
            //'choice_label' => 'name'
            //choice_label peu aussi retourner un function.
            'choice_label' => function (Category $category) {
                return strtoupper($category->getName());
            }
        ])                                              
    }
});

<h3>Transformer les données d'un formulaire grâce aux événements</h3>

// Lors de l'injection le prix et convertie dans la table en centime € grace à POST_SUBMIT.    
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $product = $event->getData();

            if ($product->getPrice() !== null) {
                $product->setPrice($product->getPrice() * 100);
            }
        });
        //On prépare le prix et on le convertie en met en dizaine € sur le creation du produit
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();

            /** @var Product */
            $product = $event->getData();

            if ($product->getPrice() !== null) {
                $product->setPrice($product->getPrice() / 100);
            }

            // if($product->getId() === null) {
            //     $form->add('category', EntityType::class, [
            //         'label' => 'catégorie',
            //         'placeholder' => '-- Choisir une catégorie --',
            //         'class' => Category::class,
            //         //'choice_label' => 'name'
            //         //choice_label peu aussi retourner un function.
            //         'choice_label' => function (Category $category) {
            //                 return strtoupper($category->getName());
            //         }
            //     ])                                              
            // }
        });
    }

<h3>Transformer des données avec un DataTransformer</h3>

Documentation officielle de Symfony sur les DataTransformers : 
https://symfony.com/doc/current/form/data_transformers.html

$builder->get('price')->addModelTransformer(new CallbackTransformer(
            //S'il y a  valeur elle sera convertie en dixaine € et afficher sur le formulaire.
            function ($value) {
                if ($value === null) {
                    return;
                }
                return $value / 100;
            },
            //S'il y a une valeur elle sera convertie en centime € puis injecter dans la base de donnée.
            function ($value) {
                if ($value === null) {
                    return;
                }
                return $value * 100;
            }

        ));

DataTransformer : factoriser le code dans une classe !
Creation dans Form un dossier DataTransformer puis un fichier CentimesTransformer.php une class.
Pour intégréer la converstion de "price" dans les formulaires mais qui pourra étre employer,
dans nimporte qu'elle formulaire ou on utilise "price". 

<?php

namespace App\Form\DataTransfomer;

use Symfony\Component\Form\DataTransformerInterface;

class CentimesTransformer implements DataTransformerInterface
{

    public function transform($value)
    {
        if (null === $value) {
            return;
        }

        return $value / 100;
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return;
        }
        return $value * 100;
    }
}

<p>Dans ProductType.php Nous pouvons utilisé "CentimesTransformer".
Avec sa class dans n'importe quelle formulaire pour convertir le prix. 
use App\Form\DataTransfomer\CentimesTransformer;
$builder->get('price')->addModelTransformer(new CentimesTransformer);</p>

Mais dans dans le chant MoneyType la convertion est déjà existant avec une option:
'divisor' => 100

->add('price', MoneyType::class, [
    'label' => 'Prix du produit',
    'attr' => [
    'placeholder' => 'taper le prix du produit en €'
    ],
    'divisor' => 100
])

<h3>Créer notre propres types de champs !</h3>

📖 Documentation officielle de Symfony - Créer ses propres types de champs : 
https://symfony.com/doc/current/form/create_custom_field_type.html
📖 Documentation officielle de Symfony sur les DataTransformers : 
https://symfony.com/doc/current/form/data_transformers.html
📖 Documentation officielle de Symfony sur les événements d'un Formulaire : 
https://symfony.com/doc/current/form/events.html
📖 Documentation officielle de Symfony pour débuter avec les forms : 
https://symfony.com/doc/current/forms.html
📖 Documentation officielle de Symfony sur le composant symfony/form : 
https://symfony.com/doc/current/components/form.html

Creation d'un dossier dans Form nommé Type dans le qu'elle je créer un fichier PriceType.php 
Dans le quelle nous allons recréer la mecanique:

namespace App\Form\Type;

use App\Form\DataTransfomer\CentimesTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dd($options);
        if ($options['divide'] === false) {
            return;
        }

        $builder->addModelTransformer(new CentimesTransformer);
    }

    public function getParent()
    {
        return NumberType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'divide' => true
        ]);
    }
}

Il suffis de déclarer la class dans le controller ProductType.php.
->add('price', PriceType::class, [
    'label' => 'Prix du produit',
    'attr' => [
    'placeholder' => 'taper le prix du produit en €'
    ],
    'divisor' => true 
])

------------------------------------

<h2>Validation des données (1 heure et 5 minutes)</h2>

<h3>Introduction à la validation des données avec Symfony</h3>
composer req validator
📖 Documentation officielle de Symfony sur la Validation : 
https://symfony.com/doc/current/validation.html
📖 Liste des contraintes de validation livrées par Symfony : 
https://symfony.com/doc/current/reference/constraints.html 

Validates PHP values against constraints.
Symfony\Component\Validator\Validator\ValidatorInterface (debug.validator)

<h3>Notions de base sur le composant Validator</h3>
Permet de validé des données suivant certaine contrainte donnée par
validator. Cette exemple permet de tester des données scalaire simple est plate.

public function edit(ValidatorInterface $validator): Response
    {
        $age = 200;

        $resultat = $validator->validate($age, [
            new LessThanOrEqual([
                'value' => 120,
                'message' => "L'âge doit être inférieur à {{ compared_value }} mais vous avez donné {{ value }}"
            ]),
            new GreaterThan([
                'value' => 0,
                'message' => "L'âge doit être superieur à 0"
            ])
        ]);

        if ($resultat->count() > 0) {
            dd("Il y a des erreur", $resultat);
        }
        dd("Tout va bien");
}
Le validateur peu validée une chaine, un booléen, un nombre......    

<h3>Validation de données complexes (tableaux)</h3>
Dans cette exemple nous allons pouvoir controler un tableau assiociatif qui à de la profondeur.
    public function edit(ValidatorInterface $validator): Response
        $client = [
            'nom' => 'Hais',
            'prenom' => 'Rodolphe',
            'voiture' => [
                'marque' => 'Hyundai',
                'couleur' => 'Noire'
            ]
        ];
        //La collection de contrainte doit refleter les données de la variable dans sa structure.
        $collection = new Collection([
            // new NotBlank permet de dire que la donner ne doit pas être vide.
            'nom' => new NotBlank(['message' => "Le nom ne doit pas être vide !"]),
            'prenom' => [
                new NotBlank(['message' => "Le prénon ne doit pas être vide"]),
                //new Length 
                new Length(['min' => 3, 'minMessage' => "Le prenom ne doit pas faire moins de 3 caractéres"])
            ],
            'voiture' => new Collection([
                'marque' => new NotBlank(['message' => 'La marque de la voiture est obligatoire']),
                'couleur' => new NotBlank(['message' => 'La couleur de la voiture est obligatoire'])
            ])
        ]);

        $resultat = $validator->validate($client, $collection);

        if ($resultat->count() > 0) {
            dd("Il y a des erreur", $resultat);
        }

        dd("Tout va bien");
    }    

<h3>Validation d'objets grâce à YAML</h3>
Pour faire une validation d'un objet grace à YAML.
Il faut tout d'abord créer un dossier dans config qui pour l'exemple sera nommer validator puis un fichier
product.yaml dans le quel nous allons créer la requette de validation au format YAML.
App\Entity\Product:
  properties:
    name:
      - NotBlank: { message: "Le nom du produit est obligatoire" }
      - Length:
          {
            min: 3,
            max: 255,
            minMessage: "Le nom du produit doit faire plus de 3 caractéres",
          }
    price:
      - NotBlank: { message: "Le prix du produit est obligatoire" }

Puis pour la validation dans ProductController.php les paramétres suivant.
public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
{
    $product = new Product;

        $resultat = $validator->validate($product);

        if ($resultat->count() > 0) {
            dd("Il y a des erreur", $resultat);
        }

        dd("Tout va bien");

}

<h3>Validation d'objets en PHP</h3>
Mais elle n'est pas conseiller car elle reste statique.
La validation peu se faire directement par l'entity exemple dans le Product.php.
Symfony basculera directement dans l'entity pour appliquer la methode validator.


public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('name', [
            new NotBlank(['message' => 'Le nom du produit est obligatoir']),
            new Length(['min' => 3, 'max' => 255, 'minMessage' => 'Le nom du produit doit contenir au moin 3 caractères'])
        ]);
        $metadata->addPropertyConstraint('price', new NotBlank(['message' => 'Le prix du produit est obligatoir']));
    }

Puis pour la validation dans ProductController.php les paramétres suivant.
public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
{
    $product = new Product;

        $resultat = $validator->validate($product);

        if ($resultat->count() > 0) {
            dd("Il y a des erreur", $resultat);
        }

        dd("Tout va bien");

}

<h3> Utiliser l'espace de noms Constraints (Assert) </h3>
Pour reduire le nombre de use pour l'utilisation de différente méthode de validator, mais peu être utiliser
pour d'autre méthode.
Il suffit d'utiliser le as Assert à la fin du use.
Avant nous appelions différent use.

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

Product.php
public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('name', [
            new NotBlank(['message' => 'Le nom du produit est obligatoir']),
            new Length(['min' => 3, 'max' => 255, 'minMessage' => 'Le nom du produit doit contenir au moin 3 caractères'])
        ]);
        $metadata->addPropertyConstraint('price', new NotBlank(['message' => 'Le prix du produit est obligatoir']));
    }

Maintenant nous pouvont en utilisé qu'un seul. Grace à l'alias Assert.
use Symfony\Component\Validator\Constraints as Assert;
Mais il faut absolument utilisé l'extention Assert\ pour pouvoir que les functions soit reconnue. 
public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('name', [
            new Assert\NotBlank(['message' => 'Le nom du produit est obligatoir']),
            new Assert\Length(['min' => 3, 'max' => 255, 'minMessage' => 'Le nom du produit doit contenir au moin 3 caractères'])
        ]);
        $metadata->addPropertyConstraint('price', new Assert\NotBlank(['message' => 'Le prix du produit est obligatoir']));
    }

<h3>Validation d'objets grâce aux annotations</h3>
Cette méthode est conseiller est la norme dans symfony.
Les function de validation sont inscrite directement dans les annotations.
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom du produit est obligatoire !")
     * @Assert\Length(min=3, max=255, minMessage="Le nom du produit doit avoir au moin 3 caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le prix du produit est obligatoire !")
     */
    private $price;

Puis pour la validation dans ProductController.php les paramétres suivant.    
public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
{
    $product = new Product;

        $resultat = $validator->validate($product);

        if ($resultat->count() > 0) {
            dd("Il y a des erreur", $resultat);
        }

        dd("Tout va bien");

}

<h3>Validation d'un formulaire</h3>

Nous pouvons aussi faire la validation directement dans le formulaire. Grace à l'objet Validator
Dans ProductType.php de form. 
exemple:

->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['placeholder' => 'taper le nom du produit'],
                'required' => false, //nous devont desactiver le required
                'constraints' => new NotBlank(['message' => "Validation du formulaire : le nom du produit ne peut pas être vide !"]),

            ])

Mais dans l'entity Product.php.
Mettre un point d'interogation pour ne plus prendre en compte le setName.
Desactivé le contrôle par symfony.
public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

idem pour le price.

->add('price', MoneyType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'taper le prix du produit en €'
                ],
                'divisor' => 100,
                'required' => false,
                'constraints' => new NotBlank(['message' => 'Le prix du produit est obligatoire'])
            ])

Mais dans l'entity Product.php.
Mettre un point d'interogation pour ne plus prendre en compte le setPrice.
Desactivé le contrôle par symfony.
public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

<h3>Les groupes de validation</h3>
📖 Documentation officielle de Symfony sur les groupes de validation : 
https://symfony.com/doc/current/validation/groups.html
Dans ProductController.php
/**
     * @Route("/admin/product/{id}/edit", name="product_edit")
     */
    public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $product = new Product;

        $resultat = $validator->validate($product);

        dd($resultat);

dans entity Product.php
Sur cette exemple nous déclarons un groupe dans l'annotation groups={"with-price"}.

     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le prix du produit est obligatoire !", groups={"with-price"})
     */
    private $price;

Quand ont fait le teste, nous n'aurons pas l'erreur sur le price que sur ne name.
Pour que le groupe soit pris en compte il faut le déclarer dans le ProductController.php
Mais in ne reconnaitra que with-price

 public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $product = new Product;

        $resultat = $validator->validate($product, null, ["with-price"]);

        dd($resultat);

Pour faire reconnaitre les validations qui n'ont pas de groupe il faut utilisé Default.

$resultat = $validator->validate($product, null, ["Default", "with-price"]);

Comment sa se passe sur un formulaire ProductController.php.

/**
     * @Route("/admin/product/{id}/edit", name="product_edit")
     */
    public function edit($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {

        $product = $productRepository->find($id);
        //Rappeler $product revient au même que $form->setData($product);
        $form = $this->createForm(ProductType::class, $product, [
            "validation_groups" => "with-price"
        ]);

Quand on valide la page il n'y aura que le prix qui sera pris en compte.
Pour que tout soit pris en compte nous devons créer un tableau "validation_groups" => ["Default", "with-price"]

    $product = $productRepository->find($id);
            //Rappeler $product revient au même que $form->setData($product);
            $form = $this->createForm(ProductType::class, $product, [
                "validation_groups" => ["Default", "with-price"]
            ]);

Mais on n'as la possibilité de créer dans l'annotation une une autre validation.
Dans entity Product.php
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom du produit est obligatoire !")
     * @Assert\Length(min=3, max=255, minMessage="Le nom du produit doit avoir au moin 3 caractères")
     * @Asset\Length(min=10, minMessage="Le nom du produit doit faire au moins 10 caractères", groups={"large=name"})
     */
    private $name;

Donc aprés si je veux large-name en validation dans le form:
Sur un formulaire ProductController.php.
    $product = $productRepository->find($id);
        //Rappeler $product revient au même que $form->setData($product);
        $form = $this->createForm(ProductType::class, $product, [
            "validation_groups" => ["large-name", "with-price"]
        ]);

Ont n'a la possibilité de créer de goupe de validation dans les annotations et le validateur ne prendra en compte
que les validations des groupe déclarée.

<h3>Finitions et versionning avec Git</h3>
Finition des validation dans entity Product.php sur la validation du formulaire

<h3>Exercice : validez les catégories !</h3>

Mettez en place des validations sur l'entité Category afin que le formulaire soit validé.

Exigences :
Le champ name ne doit pas être vide
Le champ name ne doit pas contenir moins de 3 caractères

Dans entity Category.php sur le name nous devond déclarer les message de validation.
    Ne pas oublier le use.
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom du produit est obligatoire !")
     * @Assert\Length(min=3, max=255, minMessage="Le nom du produit doit avoir au moin 3 caractères")
     */
    private $name;

    Mettre ne intérogation le setName pour qu'il ne soit plus pris en compte par symfony.   
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

Dans CategoryType.php il est impératif de desactivé le controle du required.

            $builder->add('name', TextType::class, [
                'label' => 'Nom de la category',
                'attr' => ['placeholder' => 'taper le nom du produit'],
                'required' => false,
            ]);

Dans CathegoryController.php il faut déclarer le validator, ValidatorInterface $validator.
Surtout il faut qu'il soit valide avant de le sauvegarder if ($form->isSubmitted() && $form->isValid())          
Ne pas oublier le use.
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {

        $category = $categoryRepository->find($id);

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }

Astuce :
Votre formulaire HTML ne vous laissera pas soumettre avec un champ vide car le champ possède un attribut "required", servez vous de l'inspecteur du navigateur pour supprimer cet attribut afin de faire vos tests !

<h2>Renforcement Twig : Mise en place de la navbar (16 minutes)</h2>


<h3>Mise en place de la navbar : Introduction</h3>
Dans le dossier template, shared sur le ficher _navbar.html.twig.

<a class="navbar-brand" href="/">SymShop</a>

<h3>Twig : appeler un controller directement depuis un template</h3>
📖 Documentation officielle de Symfony : appeler un controller directement depuis Twig (déprécié) :
 https://symfony.com/doc/4.1/templating/embedding_controllers.html
🤔 Baptiste Donaux : Twig render controller, le faux bon ami : 
https://www.baptiste-donaux.fr/twig-render-controller-le-faux-bon-ami/
Dans le CategoryController.php il faut créer une fonction qui permetera d'appeler les catétogories
que l'on passe sur la variable categories et qui passera par category/_menu.html.twig.

protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function renderMenuList()
    {
        //1. Aller chercher les catégories dans la base de données (repository)
        $categories = $this->categoryRepository->findAll();
        //2. Renvoyer le menu HTML sous la forme d'une Response ($this->render)
        return $this->render('category/_menu.html.twig', [
            'categories' => $categories

        ]);
    }

Après il faut créer un fichier partial dans le dossier category/_menu.html.twig.
On vas créer une boucle for du li
{% for c in categories %}
	<li class="nav-item">
		<a class="nav-link" href="#">{{ c.name }}</a>
	</li>
{% endfor %}

Dans le fichier _navbar.html.twig

Je remplace tout les li par:
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="/">SymShop</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav me-auto">
				{{ render(controller('App\\Controller\\CategoryController::renderMenulist')) }}

			</ul>
			<form class="d-flex">
				<input class="form-control me-sm-2" type="text" placeholder="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</div>
</nav>

Maintenant on peu voir toutes les catégories sur la bar de menu.

<h3>Twig : Injecter une variable globale dans nos templates</h3>

Seconde méthode
📖 Documentation officielle de Symfony - Injecter des globales dans Twig : 
https://symfony.com/doc/current/templating/global_variables.html

Nous allons dans le dosssier config, packages dans le fichier twig.yaml.
Une ligne globals: dans le quelle nous allons appeler la categoryRepository
twig:
    default_path: "%kernel.project_dir%/templates"
    form_themes:
        - bootstrap_4_layout.html.twig
    globals:
        categoryRepository: "@App\\Repository\\CategoryRepository"

Aprés il suffi d'appeler dans la _navbar.html.twig.
La variable categoryRepository.findAll() pour pouvoir afficher tout les cathégories:
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="/">SymShop</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav me-auto">
				{% for c in categoryRepository.findAll() %}
					<li class="nav-item">
						<a class="nav-link" href="#">{{ c.name }}</a>
					</li>
				{% endfor %}
			</ul>
			<form class="d-flex">
				<input class="form-control me-sm-2" type="text" placeholder="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</div>
</nav>

<h3>Mettre en place les liens utilisateurs dans la navbar</h3>
Creation des boutons Inscription, Login et Logout.
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="/">SymShop</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav me-auto">
				{% for c in categoryRepository.findAll() %}
					<li class="nav-item">
						<a class="nav-link" href="#">{{ c.name }}</a>
					</li>
				{% endfor %}
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="nav-link">Inscription</a>
				</li>
				<li class="nav-item">
					<a href="#" class="btn btn-sucess">Login</a>
				</li>
				<li class="nav-item">
					<a href="#" class="btn btn-danger">Logout</a>
				</li>

			</ul>
		</div>
	</div>
</nav>

<h2>La sécurité : authentification (1 heure et 40 minutes)</h2>
📖 Documentation officielle sur le composant Security : 
https://symfony.com/doc/current/security.html

<h3>📖 Introduction à la sécurité dans Symfony</h3>
La sécuritée se pose en deux questions différentes...

1-Authentification
Es-tu vraiment celui que tu prétends être ?

2-Autorisations
As-tu le droit de faire ce que tu veux faire ?
A tu le droit d'asceder à cette page, de voir ce bouton, de modifier tel produis.

Donc voila pourquoi il y a le composant security, symfony/security.

<h3>📖 Firewalls : des régions politiques dans nos applications</h3>

Le composant sécuritée est comme la géographie.
La sécuritée et gérer dans différent espace appeler, Les Firewalls!, chaque espace pourra avoir son autentification.
Comprendre les firewalls.Les URLs formeent les frontiéres de vos régions (firewalls).
On pourrait déffinir plusieur zone exemple:
-Zone 1: (Firewall "admin" URLs:^/admin) Formulaire de login
-Zone 2: (Firewall "api" URLs:^/api) Clé d'API
-Le reste des zones: (Firewall "main" URLs:toutes les autres) Formulaire de login

<h3>Installation du composant Security</h3>
Installation du composant sécurity:
-composer req security

Installation d'un nouveau bunddel config/packages/security.yaml
Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true]
Avec la creation d'un nouveau fichier security.yaml dans lequel on retrouve le Firewalls
firewalls:
        // La mise en place des différentes regions.
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: true
            lazy: true
            provider: users_in_memory

Ainsi que de nouveau service lier au composant de sécurité.

Autowirable Types
=================

 The following classes & interfaces can be used as type-hints when autowiring:
 (only showing classes/interfaces matching security)

 Psr\Log\LoggerInterface $securityLogger (monolog.logger.security)

 AuthenticationManagerInterface is the interface for authentication managers, which process Token authentication.
 Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface (security.authentication.manager)

 The TokenStorageInterface.
 Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface (security.token_storage)

 AccessDecisionManagerInterface makes authorization decisions.
 Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface (debug.security.access.decision_manager)

 The AuthorizationCheckerInterface.
 Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface (security.authorization_checker)

 EncoderFactoryInterface to support different encoders for different accounts.
 Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface (security.encoder_factory.generic)

 UserPasswordEncoderInterface is the interface for the password encoder service.
 Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface (security.user_password_encoder.generic)

 RoleHierarchyInterface is the interface for a role hierarchy.
 Symfony\Component\Security\Core\Role\RoleHierarchyInterface (security.role_hierarchy)

Ce service sera le plus utiliser pendant la formation.
 Helper class for commonly-needed security tasks.
 Symfony\Component\Security\Core\Security (security.helper)

 Implement to throw AccountStatusException during the authentication process.
 Symfony\Component\Security\Core\User\UserCheckerInterface (security.user_checker)

 Represents a class that loads UserInterface objects from some source for the authentication system.
 Symfony\Component\Security\Core\User\UserProviderInterface (security.user.provider.concrete.users_in_memory)

 Manages CSRF tokens.
 Symfony\Component\Security\Csrf\CsrfTokenManagerInterface (security.csrf.token_manager)

 Generates CSRF tokens.
 Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface (security.csrf.token_generator)

 Stores CSRF tokens.
 Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface (security.csrf.token_storage)

 A utility class that does much of the *work* during the guard authentication process.
 Symfony\Component\Security\Guard\GuardAuthenticatorHandler (security.authentication.guard_handler)

 Extracts Security Errors from Request.
 Symfony\Component\Security\Http\Authentication\AuthenticationUtils (security.authentication_utils)

 Firewall uses a FirewallMap to register security listeners for the given request.
 Symfony\Component\Security\Http\Firewall (debug.security.firewall)

 Encapsulates the logic needed to create sub-requests, redirect the user, and match URLs.
 Symfony\Component\Security\Http\HttpUtils (security.http_utils)

 SessionAuthenticationStrategyInterface.
 Symfony\Component\Security\Http\Session\SessionAuthenticationStrategyInterface (security.authentication.session_strategy)

<h3>L'entité User pour représenter nos utilisateurs</h3>

Nous allons créer une classe USER.

php bin/console make:user User
Nous pouvons utilisé d'autre source de base de donner mais nous utiliserons Doctrine.
 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 >
Quelle sera l'identifians de connection, par le quelle la personne sera reconnue.
 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 >
Nous pouvons avoir differente autentification, clef d'appi, ip, nom d'utilisateur.
 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).
cela à créer 

created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml
 Does this app need to hash/check user passwords? (yes/no) [yes]:

Dans le fichier security.yaml 
#// l'encodeur utilise un algorithme pour hasher les mots de passe
des utilisateurs
encoders:
        App\Entity\User:
            algorithm: //auto qui s'adapte suivant la machine

    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
        # used to reload user from session & other features (e.g. switch_user)

        #//Les providers indiquent au composant Security où se trouve les données des utilisateur
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email

            //#Les firewalls sont les "regions" de votre application dont les frontiéres sont
            matérialisées par des URLs
            firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
            #// il a été céer le main
        main:
            anonymous: true
            lazy: true
            provider: app_user_provider

Il y a eu la creation de l'entity User.php

class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
    //Les rôles permettront de gérer les Autorisation (as-tu le dorit de faire ceci ou cela ?)
    //Permet de donner des roles a l'utilisateur

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        //Le ROLE_USER représente le rôle que tous les utilisateurs possédent.
        //Tout les utilisateurs auront le ROLR_USER


<h3>Mise à jour des fixtures</h3>

Creation de la fixtures User dans le dossier src/DataFixture dans le fichier AppFixtures.
$admin = new User;

        use App\Entity\User;

        Creation du User avec le ROLE_ADMIN
        $admin->setEmail("admin@gmail.com")
            ->setPassword("passeword")
            ->setFullName("Admin")
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        //Boucle for si $u = 0 et si $u < 5 alors tu fais $u++
        for ($u = 0; $u < 5; $u++) {
            $user = new User();
            $user->setEmail("user$u@gmail.com")
                ->setFullName($faker->name())
                ->setPassword("passeword");
            Donc il va persister 5 nouveau utlisateur.
            $manager->persist($user);


Migration de la fixture:
-php bin/console d:f:l --no-interaction


<h3>Hasher les mots de passes pour plus de sécurité</h3>

Encodage des mots de passes.
Faire un autowiring pour savoir si il y a un service qui gére les passwords.
php bin/console debug:autowiring password

Autowirable Types
=================

 The following classes & interfaces can be used as type-hints when autowiring:
 (only showing classes/interfaces matching password)
Creation de $encoder avec l'utilisation du UserPasswordEncoderInterface $encoder dans le dossier src/DataFixture 
dans le fichier AppFixtures puis la mise en place de $hash et de l'appel de hash dans ->setPassword($hash).
 UserPasswordEncoderInterface is the interface for the password encoder service.
 Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface (security.user_password_encoder.generic)

class AppFixtures extends Fixture
{
    protected $slugger;
    protected $encoder;

    public function __construct(SluggerInterface $slugger, UserPasswordEncoderInterface $encoder)
    {
        $this->slugger = $slugger;
     ** $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        //Appel de faker objet
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));

        $admin = new User;

        $hash = $this->encoder->encodePassword($admin, "passeword");

        $admin->setEmail("admin@gmail.com")
            ->setPassword($hash)
            ->setFullName("Admin")
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        //Boucle for si $u = 0 et si $u < 5 alors tu fais $u++
        for ($u = 0; $u < 5; $u++) {
            $user = new User();

            $hash = $this->encoder->encodePassword($user, "passeword");

            $user->setEmail("user$u@gmail.com")
                ->setFullName($faker->name())
                ->setPassword($hash);

            $manager->persist($user);
        }

<h3>📖 Introduction aux Authenticator de Symfony</h3>

Nous allons devoir créer des classes dont la mission est d'authentifier les 
utilisateurs quand ils le demandent !

Symfony vas pour se connecté avec plusieur autentifivateur.
Chaque requéte sera vérifier pour savoir si l'utilisateur à le droit de faire ou de 
ne pas faire sur et de se connecter sur chaque chose sur symfony.
Si il la le droit de remplir le formulaire de login.
L'autentificateur vas analiser soit l'autentification à réussit soit elle a ratée.

1-Quelle est votre identité ?
Votre identifiant ou votre email.
2-Est-ce que vous existez au moin ?
Est vous existez dans la base de donnée avec cette email. 
3-Et le mot de passe ? C'est le même ?!

Si les trois étapes se passe bien "Authentification réussit !"
Cette authentification reste active le tout le temp de la connection.
Sinon ont arrive à la failure, "Authentification ratée !"

<h3>La commande make:auth</h3>

La commande make:auth
php bin/console make:auth

 What style of authentication do you want? [Empty authenticator]:
  [0] Empty authenticator
  [1] Login form authenticator
 > 0
0

 The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > LoginFormAuthenticator

 created: src/Security/LoginFormAuthenticator.php
 updated: config/packages/security.yaml
Création de guard:
guard:
    authenticators:
        - App\Security\LoginFormAuthenticator
        - 
Les authenticators seront appelés à chaque requête HTTP par Symfony pour éventuellement procéder
 à une authentification

Creation de src/Security/LoginFormAuthenticator.php
Il y a déjà les méthodes prés remplie dans le fichier qu'il restera à remplir.

<h3> Page de login et problèmes de routage</h3>

php bin/console make:controller SecurityController

 created: src/Controller/SecurityController.php
 created: templates/security/index.html.twig

Pour voir toute les routes déjà créer on utilise la commande:
php bin/console debug:router

Il y a un conflit avec le slug de CategoryController.php.

Il detecte cette route et nous emméne vers un message d'erreur
"La catégorie demandée n'existe pas"

<h3>Jouer avec les priorités des routes</h3>

📖 Documentation officielle sur la priorité des routes : 
https://symfony.com/doc/current/routing.html#priority-parameter

Pour éviter le probléme de route il faut donner une prioritée à chaque route.
Par défaut elles sont a 0.
Donc dans le src/Controller/ProductController.php nous allons priorisé la route login.
**
* @Route("/{slug}", name="product_category")
*/
public function category($slug, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneBy([
            'slug' => $slug
        ]);

        //Si la cathegory n'existe pas alors, il vas vers une erreur.
        if (!$category) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }

        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category,
        ]);
    }

Pour suprimer le cache:
php bin/console cache:clear

Mais l'ideal est de priorisé /{slug} en negatif pour évitée de priorisé plusieur route.
ProductController.php

**
* @Route("/{slug}", name="product_category", priority=-1)
*/

<h3>Formulaire de connexion (login)</h3>

📖 Documentation officielle sur le composant Security : 
https://symfony.com/doc/current/security.html 
php bin/console make:form LoginType 
 // Aucune association
 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 >

 created: src/Form/LoginType.php
Mise en place du formulaire.

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'Adresse email de connection'
                ]
            ])

            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Mot de passe ...'
                ]
            ]);
    }

Dans le SecurityController.php il faut passé le formulaire.

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(): Response
    {
        $form = $this->createForm(LoginType::class);

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView()
        ]);
    }
}

Mise en place du formulaire sur LoginType.php.

{% extends 'base.html.twig' %}

{% block title %}Connection !
{% endblock %}

{% block body %}
	<h1>Connection</h1>
	{{ form_start( formView ) }}

	{{ form_widget( formView ) }}

	<button type="submit" class="btn btn-success">Connection</button>

	{{ form_end( formView ) }}
{% endblock %}

<h3>Authenticator : la méthode supports()</h3>

Dans LoginFormAuthenticator.php nous allons créer le doignet.
En testent avec un dd($request) on se rend compte que "_route" => "security_login" 
et appeler sur tout les routes.

public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'security_login'
            && $request->isMethod('POST');
    }
Je n'interviens que si la request posséde dans ces attribus qui s'appel _route et qui égale à
security_login et aussi j'aimerai travailler que si la request est en methode POST.
Je peux controler cette personne car elle a demander à être contrôler.
Si la procédure est Ok alors il continue le processe.

<h3>Authenticator : compléter la procédure d'authentification</h3>
Dans le dossier sécurity du fichier LoginFormAuthenticator.php, nou allons créer la cinématique
 de connection.

<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{
    protected $encoder;
    // on se fait livré le service encoder pour pouvoir decodé le mot de passe
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'security_login'
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        return $request->request->get('login'); // array avec 3 infos
        // On vas faire ressortir les 3 info dans un tableau, pour les présenter à la function
        //suivante.
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['email']);
        //Je veux retourné le resultat $userProvider qui a une méthode loadUserByUsername qui à comme email par $credentials['email']
        //grace au info qui ont etait retourné dans l'utilisateur de login.
        //On passe par UserProviderInterface qui se trouve dans le sécurity.yaml ou tout les infos.
        //Sont deja paramétrer app_user_provider: entity: class: App\Entity\User property: email
        //Une fois vérifier ont vas retourné à la méthode checkCredentials.
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // Vérifier que le mot de passe fourni, correspond bien au mot de passe de la base de données.
        //Je veux vérifier que $credentials['passeword'] => $user->getPassword() que sa match bien.
        //Doit retourné vrais ou faux si les valeurs sont valides
        return $this->encoder->isPasswordValid($user, $credentials['passeword']);
    }

<h3>Les échecs possibles pendant l'authentification</h3>
L'Authenticator est un douanier qui vas vérifier les information de connection, il vas verifier les informations qui se trouve dans la base de donnée.
Toujours dans le dossier sécurity du fichier LoginFormAuthenticator.php.

 public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        //Il faut le laisser vide, il restera sur la page lOGIN.
        //dd("Failure", $exception);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return new RedirectResponse('/');
        //Si l'authentification a reussit il retourne directement sur home page.
    }

<h3>Obtenir la raison de l'échec de l'authentification (AuthenticationUtils)</h3>

php bin/console debug:autowiring auth

Autowirable Types
=================

 The following classes & interfaces can be used as type-hints when autowiring:
 (only showing classes/interfaces matching auth)
 
 AuthenticationManagerInterface is the interface for authentication managers, which process Token authentication.     
 Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface (security.authentication.manager)      
 
 The TokenStorageInterface.
 Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface (security.token_storage)
 
 AccessDecisionManagerInterface makes authorization decisions.
 Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface (debug.security.access.decision_manager)
 
 The AuthorizationCheckerInterface.
 Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface (security.authorization_checker)

 A utility class that does much of the *work* during the guard authentication process.
 Symfony\Component\Security\Guard\GuardAuthenticatorHandler (security.authentication.guard_handler)

Nous allons tester ce service.
 Extracts Security Errors from Request.
 Symfony\Component\Security\Http\Authentication\AuthenticationUtils (security.authentication_utils)

 SessionAuthenticationStrategyInterface.
 Symfony\Component\Security\Http\Session\SessionAuthenticationStrategyInterface (security.authentication.session_strategy)

 1 more concrete service would be displayed when adding the "--all" option.

Dans le fichier security.yaml nous allons utilisé AuthenticationUtils.
Nous appelons la 
<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
Dans le fichier security.yaml nous allons utilisé
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $form = $this->createForm(LoginType::class);

        //teste utils
        //dump($utils->getLastAuthenticationError(), $utils->getLastUsername());

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }
}

Dans le LoginFormAuthenticator.php nous integrons Security::AUTHENTICATION_ERROR
Voir AuthenticationUtils.php
public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // On appel la constante de l'erreur dans Security::AUTHENTICATION_ERROR et on stock l'erreur dans $exception.
        $request->attributes->set(Security::AUTHENTICATION_ERROR, $exception);
    }

Et formalisons le message d'erreur sur la page login.html.twig.
Avec un if error.

{% extends 'base.html.twig' %}

{% block title %}Connection !
{% endblock %}

{% block body %}
	<h1>Connection</h1>
	{% if error %}
		<div class="alert alert-danger">
			{{ error.message }}
		</div>
	{% endif %}
	{{ form_start( formView ) }}

	{{ form_widget( formView ) }}

	<button type="submit" class="btn btn-success">Connection</button>

	{{ form_end( formView ) }}
{% endblock %}

<h3>Modifier les messages d'erreur</h3>

Dans le fichier LoginFormAuthenticator.php nous intégrons les messages personaliser.
 
 public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //Si tout se passe bien j'aimerai retournet return $userProvider->loadUserByUsername($credentials['email'])
        //Mais si il lance une execption alors moi je veus lancer une nouvelle AuthenticationException 
        //avec comme message "Cette adress email n'est pas connue".
        try {
            return $userProvider->loadUserByUsername($credentials['email']);
        } catch (UsernameNotFoundException $e) {
            throw new AuthenticationException("Cette adress email n'est pas connue");
        }

        //Je veux retourné le resultat $userProvider qui a une méthode loadUserByUsername qui à comme email par $credentials['email']
        //grace au info qui ont etait retourné dans l'utilisateur de login.
        //On passe par UserProviderInterface qui se trouve dans le sécurity.yaml ou tout les infos.
        //Sont deja paramétrer app_user_provider: entity: class: App\Entity\User property: email
        //Une fois vérifier ont vas retourné à la méthode checkCredentials.
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // Vérifier que le mot de passe fourni, correspond bien au mot de passe de la base de données.
        //Je veux vérifier que $credentials['passeword'] => $user->getPassword() que sa match bien.
        //Doit retourné vrais ou faux si les valeurs sont valides
        $isValid = $this->encoder->isPasswordValid($user, $credentials['password']);
        //Si elle n'ait pas valide alors elle retourne le message "Les informations de connexion ne correspondent pas".
        if (!$isValid) {
            throw new AuthenticationException("Les informations de connexion ne correspondent pas");
        }
        // Sinon Ok
        return true;
    }

Dans le SecurityController.php
Nous souhaitons conserver l'email en cas d'erreur.

<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        //Si email est dans getLastUsername() alors il sera stocket sous forme de tableau dans LoginType.
        $form = $this->createForm(LoginType::class, ['email' => $utils->getLastUsername()]);

        //teste utils
        //dump($utils->getLastAuthenticationError(), $utils->getLastUsername());

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }
}

<h3>📖 Premier récapitulatif</h3>

Dans le sécurity.yaml nous avons un Autenticator pour le fiwerwall main, l'authenticator est comme un doignés, il a pout but de nous authentifiez et quand vous lui demandée. Il n'intervient que si les information renseigner sont identiques au information stocker en base. 

<h3>L'Authenticator "form_login" livré par Symfony</h3>

Mais nous pouvont passé directement par l'opérateur de symfony,dans security.yaml.
        main:
            anonymous: true
            lazy: true
            provider: app_user_provider
            # guard:
            #     authenticators:
            #         - App\Security\LoginFormAuthenticator
            //validation sans Authentificator.
            form_login:
                login_path: security_login
                check_path: security_login
                //en paramétrant les variables de symfony.Pour étre utiliser avec mon form.
                username_parameter: login[email] 
                password_parameter: login[password]


<h3>Gérer la déconnexion avec l'option "logout"</h3>

Dans le secutity.yaml nous allons créer le logout.

security:
    encoders:
        App\Entity\User:
            algorithm: auto

    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: true
            lazy: true
            provider: app_user_provider
            # guard:
            #     authenticators:
            #         - App\Security\LoginFormAuthenticator

            form_login:
                login_path: security_login
                check_path: security_login
                username_parameter: login[email]
                password_parameter: login[password]

            logout:
                path: security_logout

            # activate different ways to authenticate
            # https://symfony.com/doc/current/security.html#firewalls-authentication

            # https://symfony.com/doc/current/security/impersonating_user.html
            # switch_user: true

    # Easy way to control access for large sections of your site
    # Note: Only the *first* access control that matches will be used
    access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }

Dans SecurityController.php nous allons créer la route pour le logout.
    /**
    * @Route("/logout", name="security_logout")
    */
    public function logout()
    {
    }

<h3>Mise en forme de la barre de navigation</h3>

Documentation symfony App variable.
https://symfony.com/doc/2.8/templating/app_variable.html
https://symfony.com/doc/current/templates.html

Dans le dossier shared du fichier _navbar.html.
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="/">SymShop</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav me-auto">
				{% for c in categoryRepository.findAll() %}
					<li class="nav-item">
						<a class="nav-link" href="#">{{ c.name }}</a>
					</li>
				{% endfor %}
			</ul>
			<ul class="navbar-nav">
            // integration de l'app variable pour un choix des commandes de connection suivant la position de connection.
				{% if app.user %}
					<li class="nav-item">
						<a href="{{ path('security_logout') }}" class="btn btn-danger">Logout</a>
					</li>
				{% else %}
					<li class="nav-item">
						<a href="#" class="nav-link">Inscription</a>
					</li>
					<li class="nav-item">
						<a href="{{ path('security_login') }}" class="btn btn-sucess">Login</a>
					</li>
				{% endif %}

			</ul>
		</div>
	</div>
</nav>

<h3>Interlude : les commandes essentielles (config:dump et debug:config)</h3>
Pour plus d'autonomie 
php bin/console debug:config

https://symfony.com/doc/current/reference/configuration/debug.html

Available registered bundles with their extension alias if available
====================================================================

 ---------------------------- ------------------------ 
  Bundle name                  Extension alias         
 ---------------------------- ------------------------ 
  DebugBundle                  debug
  DoctrineBundle               doctrine
  DoctrineFixturesBundle       doctrine_fixtures       
  DoctrineMigrationsBundle     doctrine_migrations     
  FrameworkBundle              framework
  MakerBundle                  maker
  MonologBundle                monolog
  SecurityBundle               security
  SensioFrameworkExtraBundle   sensio_framework_extra  
  TwigBundle                   twig
  TwigExtraBundle              twig_extra
  WebProfilerBundle            web_profiler
 ---------------------------- ------------------------

 // Provide the name of a bundle as the first argument of this command to dump its configuration. (e.g.
 // debug:config FrameworkBundle)

 // For dumping a specific option, add its path as the second argument of this command. (e.g. debug:config
 // FrameworkBundle serializer to dump the framework.serializer configuration)

exemple:
php bin/console debug:config security                                          
                           
Current configuration for extension with alias "security"
=========================================================

security:
    encoders:
        App\Entity\User:
            algorithm: auto
            migrate_from: {  }
            hash_algorithm: sha512
            key_length: 40
            ignore_case: false
            encode_as_base64: true
            iterations: 5000
            cost: null
            memory_cost: null
            time_cost: null
    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
                manager_name: null
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
            methods: {  }
            user_checker: security.user_checker
            stateless: false
            lazy: false
        main:
            anonymous:
                lazy: false
                secret: null
            lazy: true
            provider: app_user_provider
            form_login:
                login_path: security_login
                check_path: security_login
                username_parameter: 'login[email]'
                password_parameter: 'login[password]'
                remember_me: true
                use_forward: false
                require_previous_session: false
                csrf_parameter: _csrf_token
                csrf_token_id: authenticate
                enable_csrf: false
                post_only: true
                always_use_default_target_path: false
                default_target_path: /
                target_path_parameter: _target_path
                use_referer: false
                failure_path: null
                failure_forward: false
                failure_path_parameter: _failure_path
            logout:
                path: security_logout
                csrf_parameter: _csrf_token
                csrf_token_id: logout
                target: /
                invalidate_session: true
                delete_cookies: {  }
                handlers: {  }
            methods: {  }
            security: true
            user_checker: security.user_checker
            stateless: false
    access_control: {  }
    access_decision_manager:
        strategy: affirmative
        allow_if_all_abstain: false
        allow_if_equal_granted_denied: true
    access_denied_url: null
    session_fixation_strategy: migrate
    hide_user_not_found: true
    always_authenticate_before_granting: false
    erase_credentials: true
    enable_authenticator_manager: false
    role_hierarchy: {  }

Exemple de la console dump:
php bin/console config:dump

Available registered bundles with their extension alias if available
====================================================================

 ---------------------------- ------------------------
  Bundle name                  Extension alias        
 ---------------------------- ------------------------
  DebugBundle                  debug
  DoctrineBundle               doctrine
  DoctrineFixturesBundle       doctrine_fixtures
  DoctrineMigrationsBundle     doctrine_migrations
  FrameworkBundle              framework
  MakerBundle                  maker
  MonologBundle                monolog
  SecurityBundle               security
  SensioFrameworkExtraBundle   sensio_framework_extra
  TwigBundle                   twig
  TwigExtraBundle              twig_extra
  WebProfilerBundle            web_profiler
 ---------------------------- ------------------------

 // Provide the name of a bundle as the first argument of this command to dump its default configuration. (e.g.
 // config:dump-reference FrameworkBundle)
 //
 // For dumping a specific option, add its path as the second argument of this command. (e.g.
 // config:dump-reference FrameworkBundle profiler.matcher to dump the
 // framework.profiler.matcher configuration)

php bin/console config:dump security
Permet de voir tout les options du composant sécurity.

<h2>La sécurité : autorisations et rôles (50 minutes)</h2>

<h3>Introduction aux autorisations dans Symfony 5</h3>
Dans se chapitre nous allons voir les ROLES.
Les ROLES permettent de donner des droits au utilisateurs.

ROLE_USER     ROLE_ADMIN        ROLE_CE_QUE_JE_VEUX

<h3>La méthode "start()" de l'authenticator et les ACL</h3>
Dans le fichier security.yaml nous pouvons bloquer des accées vias les roles dans le access_control:

security:
    encoders:
        App\Entity\User:
            algorithm: auto

    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: true
            lazy: true
            provider: app_user_provider
            guard:
                authenticators:
                    - App\Security\LoginFormAuthenticator

            # form_login:
            #     login_path: security_login
            #     check_path: security_login
            #     username_parameter: login[email]
            #     password_parameter: login[password]

            logout:
                path: security_logout

            # activate different ways to authenticate
            # https://symfony.com/doc/current/security.html#firewalls-authentication

            # https://symfony.com/doc/current/security/impersonating_user.html
            # switch_user: true

    # Easy way to control access for large sections of your site
    # Note: Only the *first* access control that matches will be used
    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }

Dans le fichier LoginFormAuthenticator.php nous devons retouner vers une adresse sur:

use Symfony\Component\HttpFoundation\RedirectResponse;

public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/login');
    }

<h3> Découverte du service Security</h3>

php bin/console debug:autowiring security

Autowirable Types
=================
Nous allons utilisé une classe sécurity.
Helper class for commonly-needed security tasks.
 Symfony\Component\Security\Core\Security (security.helper)

Dans le dossier du contrôler du fichier CatheroyController.php
On se fait livrer Security $security.

use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

/**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em, Security $security): Response
    {
        //On passe le user dans la classe sécurity et on le passe en getUser.
        $user = $security->getUser();

        //Si le user n'est pas admin retourne à zero il sera redirigé dans le security_login
        if ($user === null) {
            return $this->redirectToRoute('security_login');
        }
        //Mais si le user na pas la role admin il aura un message.
        if (!in_array("ROLE_ADMIN", $user->getRoles())) {
            throw new AccessDeniedException("Vous n'avez pas le droit d'accéder à cette ressource");
        }


        $category = $categoryRepository->find($id);

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }

<h2> Les raccourcis de l'AbstractController pour la sécurité</h3>
Dans la CathegoryControlerr.php ont peu se faire livrais par AbstractController,
La class sécurity.

    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em, Security $security): Response
    {
        //en utilisant la méthode denyAccessUnlessGranted nous pouvont tester si c'est un USER qui à le rôle admin ou passe
        //et renvoyer la réponse.
        $this->denyAccessUnlessGranted("ROLE_ADMIN", null, "Vous n'avez pas le droit d'accéder à cette ressource");
        
        $category = $categoryRepository->find($id);

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }

<h3>Contrôler les accès grâce à l'annotation @IsGranted</h3>
Dans la CathegoryController.php ont peu se faire livrais le use qui vas avec.
Dans cette section nous pouvons directement mettre la méthode de sécurité des ROLEs dans l'annotation.

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     * //Voici la ligne qui permet de savoir si vous pouvez allé sur la page avec @IsGranted.
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas le droit d'accéder à cette ressource")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em): Response
    {
        
        $category = $categoryRepository->find($id);

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }

<h3>Contrôler l'accès à un objet en particulier</h3>
Le but est de définir la personne qui à créer la category en creans une relation.
Entre la Category et le user. Afin de bloquer le le user qui nas pas créer la category
php bin/console make:entity Category

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > owner

 Field type (enter ? to see all types) [string]:
 > relation
relation

 What class should this entity be related to?:
 > User
User

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne
ManyToOne
;49m
 Is the Category.owner property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 Do you want to add a new property to User so that you can access/update Category objects from it -
 e.g. $user->getCategories()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related Category objects from it.

 New field name inside User [categories]:
 >

 updated: src/Entity/Category.php
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):        
  Success! 


Dans la CathegoryController.php ont peu se faire livrais le use est faire le controle entre le createur de la category et la category.
    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em): Response
    {



        $category = $categoryRepository->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Cette catégory n'existe pas");
        }
        //1.Récupérer l'utilisateur
        $user = $this->getUser();
        //2.Rediriger si personne n'est connecté
        if (!$user) {
            return $this->redirectToRoute("security_login");
        }
        //3.Vérifier si c'est le créateur de la catégorie
        if ($user !== $category->getOwner()) {
            throw new AccessDeniedHttpException("Vous n'êtes pas le propriétaire de cette catégorie");
        }

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }

<h3>Encapsuler la logique d'accès dans un Voter</h3>

📖 Documentation officielle de Symfony sur les Voters :
https://symfony.com/doc/current/security/voters.html

📖 En savoir plus sur les annotations de sécurité comme @IsGranted :
https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/security.html
https://symfony.com/bundles/SensioFrameworkExtraBundle/current/index.html

Les voters permettent d'encapsuler et de centraliser une logique d'accès dans une classe.
Elle permait d'éditer des droit.


php bin/console make:voter CategoryVoter

 created: src/Security/Voter/CategoryVoter.php
  Success! 
 Next: Open your voter and add your logic.
 Find the documentation at https://symfony.com/doc/current/security/voters.html


Creation du dossier voter et du fichier CategoryVoter.php

<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CategoryVoter extends Voter
{
    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['CAN_EDIT'])
            && $subject instanceof \App\Entity\Category;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'CAN_EDIT':
                return $subject->getOwner() === $user;
                // return true or false
        }

        return false;
    }
}

Dans le fichier CategoryController.php on génère l'accés au CategoryVoter.php
Cette solution reste la plus adapter pour notre projet.
    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em, Security $security): Response
    {



        $category = $categoryRepository->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Cette catégory n'existe pas");
        }

        //Grace à cette ligne nous faisont appel au voter.
        $this->denyAccessUnlessGranted('CAN_EDIT', $category, "Vous n'êtes pas le propriétaire de cette catégorie");
        

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }
Mais nous pouvons le faire directement sur la route.    
Mais cette solution n'est pas la mieux adapté pour notre projet
    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     * @IsGranted("CAN_EDIT", subject="id", message="Vous n'êtes pas le propriétaire de cette catégorie")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em, Security $security): Response
    {



        $category = $categoryRepository->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Cette catégory n'existe pas");
        }
        //$security->isGranted('CAN_EDIT', $category);
        //$this->denyAccessUnlessGranted('CAN_EDIT', $category->getId(), "Vous n'êtes pas le propriétaire de cette catégorie");
        // $user = $this->getUser();

        // if (!$user) {
        //     return $this->redirectToRoute("security_login");
        // }

        // if ($user !== $category->getOwner()) {
        //     throw new AccessDeniedHttpException("Vous n'êtes pas le propriétaire de cette catégorie");
        // }

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }

Adaptation du fichier CategoryVoter.php pour la relation avec la route.

<?php

namespace App\Security\Voter;

use App\Repository\CategoryRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CategoryVoter extends Voter
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['CAN_EDIT'])
            && is_numeric($subject);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        $category = $this->categoryRepository->find($subject);

        if (!$category) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'CAN_EDIT':
                return $category->getOwner() === $user;
                // return true or false
        }

        return false;
    }
}

<h3>📖 Vraiment comprendre les Voters</h3>
La logique des voters, pourquoi des voters

Par exemple pour un CAN_EDIT ont pourrait avoir plusieur Voter1, Voter2 et Voter3.
On peu créer plusieur voter pour une même question.
Symfony posséde un access desition manager, il appelera tout les voters; Voter1, Voter2 et Voter3.
Qui reponderon pour pouvoir voté et il vont pouvoir dire si ils ont le droit ou ils n'ont pas le droit
Voter1 ok, Voter2 negattif, Voter3 ok.
Nous allons pouvoir créer une stratégie de prise de décision:
(La statégie unanimous)
Par exemple si sur 10 voter il y en n'a un seul qui dis non alors pas d'access a l'edition de la category.
(La statégie consensus)
Par exemple si sur 10 voter il y en n'a 6 qui dis oui alors vous avez access a l'edition de la category.
(La statégie affirmative)
Par exemple si sur 10 voter il y en n'a 1 qui dis oui alors vous avez access a l'edition de la category.

Les voter se sont des classes qui vont chacune avoir leur logique pour déterminer si on n'a le droit et elles peuvent se cumuler et peuvent repondre des chose différentes des une des autres. Chacune vas voter, suivant la stratégie qui à était mis en place dans le fichier de configue. Qui dira si on n'a acces ou pas.

Grace au voter on passe de droit d'essentialisation (ROLES), je SUIS un ADMIN a je SUIS un MODERATOR, 
a une strategie de droit d'autorisation, j'ai le DROIT de FAIRE CECI, J'ai le DROIT de FAIRE CELA.
Cette personne à le droit de modifier cette category, se produit, de la voir de l'afficher de le suprimer.
On n'est sur une logique d'action.

<h3>Remise en place avant de passer à la suite</h3>
📖 Documentation officielle de Symfony sur les Voters : 
https://symfony.com/doc/current/security/voters.html
📖 En savoir plus sur les annotations de sécurité comme @IsGranted : 
https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/security.html
📖 Documentation officielle sur le composant Security : 
https://symfony.com/doc/current/security.html 

Fichier security.yaml retour en arriere.
security:
    encoders:
        App\Entity\User:
            algorithm: auto

    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: true
            lazy: true
            provider: app_user_provider
            //commente guard.
            # guard:
            #     authenticators:
            #         - App\Security\LoginFormAuthenticator
            //Reactivation de Form login.
            form_login:
                login_path: security_login
                check_path: security_login
                username_parameter: login[email]
                password_parameter: login[password]

            logout:
                path: security_logout

            # activate different ways to authenticate
            # https://symfony.com/doc/current/security.html#firewalls-authentication

            # https://symfony.com/doc/current/security/impersonating_user.html
            # switch_user: true

    # Easy way to control access for large sections of your site
    # Note: Only the *first* access control that matches will be used
    //controle par le role ADMIN
    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }

Supression de exemple des autorisation qui se gérer pas security.yaml
    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em): Response
    {

        $category = $categoryRepository->find($id);

        if (!$category) {
            throw new NotFoundHttpException("Cette catégory n'existe pas");
        }

        $form = $this->createform(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formView' => $formView
        ]);
    }



