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

<h2>La session dans Symfony 5 (1 heure et 30 minutes)</h2>

<h3>Mise en place du panier et découverte de la session</h3>

php bin/console make:controller CartController

 created: src/Controller/CartController.php
 created: templates/cart/index.html.twig

Mise en place de la gestion du panier sur CartController.php

<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, Request $request): Response
    {
        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $request->getSession()->get('cart', []);

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++; //si le produit est déjà en panier il ajouterat +1
        } else {
            $cart[$id] = 1; // Si le produit n'est pas dans le panier il metrat 1
        }

        // 6. Enregistrer le tableau mis à jour dans la session
        $request->getSession()->set('cart', $cart);
        // Supression de cart
        //$request->getSession()->remove('cart');
        //teste
        dd($request->getSession()->get('cart'));
    }
}

Appel de cart dans show.html.twig

<a href="{{ path('cart_add', {'id': product.id}) }}" class="btn btn-success btn-lg">
	<i class="fas fa-shopping-cart"></i>
	Ajouter au panier
</a>

<h3>Sécuriser la procédure d'ajout d'un produit au panier</h3>
Creation de la sécurisation d'un panier sur CartController.php
<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * //requirements={"id":"\d+"} permet d'imposé l'appel d'un nombre.
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, Request $request, ProductRepository $productRepository): Response
    {
        // 0. Securisation: est-ce que le produit existe ?
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $request->getSession()->get('cart', []);

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++; //si le produit est déjà en panier il ajouterat +1
        } else {
            $cart[$id] = 1; // Si le produit n'est pas dans le panier il metrat 1
        }

        // 6. Enregistrer le tableau mis à jour dans la session
        $request->getSession()->set('cart', $cart);
        // Supression de cart
        //$request->getSession()->remove('cart');
        //teste
        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }
}

<h3>Se faire "livrer" la session grâce à la SessionInterface</h3>
Dans l'argument resolver permet de passé tout

<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    /**
     * //requirements={"id":"\d+"} permet d'imposé l'appel d'un nombre.
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, ProductRepository $productRepository, SessionInterface $session, EntityManagerInterface $em): Response
    {
        // 0. Securisation: est-ce que le produit existe ?
        $product = $productRepository->find($id);


        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $session->get('cart', []);

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++; //si le produit est déjà en panier il ajouterat +

        } else {
            $cart[$id] = 1; // Si le produit n'est pas dans le panier il metrat 1
        }

        // 6. Enregistrer le tableau mis à jour dans la session
        $session->set('cart', $cart);
        // Supression de cart
        //$request->getSession()->remove('cart');
        //teste
        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }
}

<h3>Découverte des "bags" et du FlashBag</h3>

Les données de la Session sont stockées dans des ParaméterBags (sortes de surcouches de tableaux).
Les information sont rangées dans des sacs des bags en anglais.
Quand nous faisonts un dd($session); dans CartController.php
Voici de qu'il nous retourne sur (https://127.0.0.1:8000/cart/add/1011)

CartController.php on line 47:
Symfony\Component\HttpFoundation\Session\Session {#879 ▼
  #storage: Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage {#903 ▶}
  -flashName: "flashes"
  -attributeName: "attributes"
  -data: &2 array:2 [▼
    // il nous retourne un sac _sf2_attributes qui nous retourne un tableau cart.

    "_sf2_attributes" => &1 array:5 [▼
      "_csrf/https-login" => "-SOG3QuA7DOwaSwWJdNFyv8CDxONHzmOMD_NPcR3ybc"
      "_security_main" => "O:74:"Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken":3:{i:0;N;i:1;s:4:"main";i:2;a:5:{i:0;O:30:"Proxies\__CG__\App\Entity\User":7:{ ▶"
      "_csrf/https-category" => "XY2NCyPLEpB2Mgu6u050g9hAFOAwDc-ggNNJv2068lg"
      "_csrf/https-product" => "psWrbfquXPp4D2ooJQkTskHbVc1ThEjfAxtepOtVhCA"
      "cart" => array:1 [▼
        1011 => 4
      ]
    ]
    "_symfony_flashes" => &3 []
  ]
  -usageIndex: &4 4
  -usageReporter: array:2 [▼
    0 => Symfony\Component\HttpKernel\EventListener\SessionListener {#107 ▶}
    1 => "onSessionUsage"
  ]
}

A chaque fois que nous faisons appel à $session->set('cart', $cart);
Il créera un sac .

Mais nous pouvont créer des sac volontairement avec $session->registerBag(new bag)
Mais "_symfony_flashes" => &3 [] lui est comme un repondeur ont peux lui passé des messages et  il permet d'afficher des messages coté l'utilisateur.

dd($session->getBag('flashes'));

CartController.php on line 49:
Symfony\Component\HttpFoundation\Session\Flash\FlashBag {#661 ▼
  -name: "flashes"
  -flashes: & []
  -storageKey: "_symfony_flashes"
}

Pour écrire un message avec flashBag.

    /** @var FlashBag  */
    $flashBag = $session->getBag('flashes');

    $flashBag->add('success', "Tout s'est bien passé");
    $flashBag->add('warning', "Atention !");
    //teste
    dd($flashBag);

retour du test

CartController.php on line 54:
Symfony\Component\HttpFoundation\Session\Flash\FlashBag {#880 ▼
  -name: "flashes"
  -flashes: & array:2 [▼
    "success" => array:1 [▼
      0 => "Tout s'est bien passé"
    ]
    "warning" => array:1 [▼
      0 => "Atention !"
    ]
  ]
  -storageKey: "_symfony_flashes"
}

Mais quand on lit le message il disparaisse.

    /** @var FlashBag  */
    $flashBag = $session->getBag('flashes');

    $flashBag->add('success', "Tout s'est bien passé");
    $flashBag->add('warning', "Atention !");
    //en realisant un dump en get nous simulons la lecture du message.
    dump($flashBag->get('success'));
    //teste
    dd($flashBag);

retour du test  success à disparus du fait de sa lecture.

CartController.php on line 54:
array:1 [▼
  0 => "Tout s'est bien passé"
]
CartController.php on line 56:
Symfony\Component\HttpFoundation\Session\Flash\FlashBag {#661 ▼
  -name: "flashes"
  -flashes: & array:1 [▼
    "warning" => array:6 [▶]
  ]
  -storageKey: "_symfony_flashes"
}

La methode add permet de d'ajouter les messages alors que la méthode get permet de lire les messages.

<h3>Afficher les message Flash dans Twig</h3>

Dans show.html.twig
Dans vos fichiers Twig, vous avez accés à une variable appelée "app" 
qui contient beaucoup d'info intéressantes.
https://symfony.com/doc/2.8/templating/app_variable.html
https://twig.symfony.com/
https://symfony.com/doc/current/reference/twig_reference.html

Il permet d'afficher le message dans quand il y a un ajoute au panier.
Puis le suprime au rafraichissement.
{{ dump(app.session.getBag('flashes').get('success')) }}

Mais symfony de twig il y a plus simple:
{{ dump(app.flashes) }}

Mais il est possible de selectionnné le message programmer.
Permet de recevoir les messages de success.
{{ dump(app.flashes('success')) }}

Permet d'afficher des message sous forme de tableau.

Dans show.html.twig on rajout une boucle for:

{% extends "base.html.twig" %}

{% block title %}
	page de
	{{ product.name }}
{% endblock %}

{% block body %}
    //Pour afficher les messages nous mettons en place les boucles for. 
	{% for rubrique, messages in app.flashes %}
		<div class="alert alert-{{ rubrique }}">
			{% for message in messages %}
				<p>{{ message }}</p>
			{% endfor %}
		</div>
	{% endfor %}

Dans le CartController.php sur la fiche d'un produit.

        /** @var FlashBag  */
        $flashBag = $session->getBag('flashes');

        $flashBag->add('success', "Le produit a bien été ajouté au panier");
        $flashBag->add('info', "Une petit information");
        $flashBag->add('warning', "Attention !");
        $flashBag->add('success', "Un autre succés");

Il vas afficher les différent messages.

Mais il est préférable de pouvoir l'intégrer sur tout les pages donc il doit étre 
mis dans le base.html.

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			{% block title %}Welcome!
			{% endblock %}
		</title>
		{# Run `composer require symfony/webpack-encore-bundle`
																												and uncomment the following Encore helpers to start using Symfony UX #}
		{% block stylesheets %}
			<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
		{% endblock %}

		{% block javascripts %}
			{#{{ encore_entry_script_tags('app') }}#}
		{% endblock %}
	</head>
	<body>
		{% include "shared/_navbar.html.twig" %}
		<div class="container pt-5">
			{% for rubrique, messages in app.flashes %}
				<div class="alert alert-{{ rubrique }}">
					{% for message in messages %}
						<p>{{ message }}</p>
					{% endfor %}
				</div>
			{% endfor %}

			{% block body %}{% endblock %}
		</div>

		{% block javascritps %}{% endblock %}
	</body>
</html>

<h3>Les raccourcis de l'AbstractController</h3>

Il est possible de se faire livré le FlashBagInterface $flashBag et ainsi pouvoir 
 se faire livrée le flashBag.


 public function add($id, ProductRepository $productRepository, SessionInterface $session, FlashBagInterface $flashBag): Response
    {

        // 0. Securisation: est-ce que le produit existe ?
        $product = $productRepository->find($id);


        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $session->get('cart', []);

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++; //si le produit est déjà en panier il ajouterat +


        } else {
            $cart[$id] = 1; // Si le produit n'est pas dans le panier il metrat 1
        }

        // 6. Enregistrer le tableau mis à jour dans la session
        $session->set('cart', $cart);

        //L'utilisation de flashBag sera identique.
        $flashBag->add('success', "Le produit a bien été ajouté au panier");

        // Supression de cart
        //$request->getSession()->remove('cart');

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }
}

Mais nous pouvont aussi nous faire livrée le flashBag.
Directement avec:

$this->addFlash('success', "Le produit a bien été ajouté au panier");

Mais sans le (FlashBagInterface $flashBag) grace à l'AbstractController.

<h3>Refactoring Twig et inclusion de templates</h3>
Mettre en fonction tout les Ajouté au panier sur les différentes pages.

Home.html.twig

<a href="{{ path('cart_add', {'id': p.id}) }}" class="btn btn-succes btn-sm">Ajouté</a>

Dans _navbar.html.twig

Mise en place de la connection sur le menu des categories

<div class="collapse navbar-collapse" id="navbarColor03">
	<ul class="navbar-nav me-auto">
		{% for c in categoryRepository.findAll() %}
			<li class="nav-item">
				<a class="nav-link" href="{{ path('product_category', {'slug': c.slug}) }}">{{ c.name }}</a>
			</li>
		{% endfor %}
	</ul>

Dans category.html.twig nous ajoutons sur les différentes etiquette de produis la jonction ajout.

<a href="{{ path('cart_add', {'id': p.id}) }}" class="btn btn-succes btn-sm">Ajouté</a>

Mais dans les différentes page nous avont le même code que nous avons modifier.
Donc pour éviter la redondance de code nous créons _product_card.html.twig
Puis nous copions le code redondant.

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
		<a href="{{ path('product_show', {'category_slug': p.category.slug, 'slug':p.slug } ) }}" class="btn btn-primery btn-sm">
			Dètails</a>
		<a href="{{ path('cart_add', {'id': p.id}) }}" class="btn btn-succes btn-sm">Ajouté</a>

	</div>
</div>

Aprés il suffit de remplacer le code dans les différentes page par: 
Maintenant il devient accéssible pour d'autre page aussi.
<div class="row">
	{% for p in category.products %}
		<div class="col-3">
			{% include "product/_product_card.html.twig" %}
		</div>
	{% endfor %}
</div>

Si dans la boucle for de twig la variable est différente des autres variable ils est possible
de la passée dans l'include avec un complément with {'p': product}.
Exemple dans la home.html.twig
<div class="row">
	{% for product in products %}
		<div class="col">
			{% include "product/_product_card.html.twig" with {'p': product} %}
		</div>
	{% endfor %}
</div>

<h3>Afficher l'état du panier dans une page</h3>

Creation de la route pour pouvoir afficher l'etat du panier. 
Dans CartController.php

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show(SessionInterface $session, ProductRepository $productRepository)
    {
        $detaileCart = [];

        //[12 => ['product' => ..., 'quantity' => qté]]
        //https://www.php.net/manual/fr/control-structures.foreach.php
        // On affiche un tableau avec la session et on get le panier dans un tableau qui est associer avec l'$id 
            du tableau et la quantitée.
        foreach ($session->get('cart', []) as $id => $qty) {
            $detaileCart[] = [
                'product' => $productRepository->find($id), //affiche le produit
                'qty' => $qty //affiche la quantité ajouté
            ];
        }

        dd($detaileCart);

        return $this->render('cart/index.html.twig', [
            'items' => $detaileCart
        ]);
    }

Integration du calcule total du panier dans CartController.php
    /**
     * @Route("/cart", name="cart_show")
     */
    public function show(SessionInterface $session, ProductRepository $productRepository)
    {
        $detaileCart = [];
        $total = 0;

        //[12 => ['product' => ..., 'quantity' => qté]]
        foreach ($session->get('cart', []) as $id => $qty) {
            $product = $productRepository->find($id);
            $detaileCart[] = [
                'product' => $product,
                'qty' => $qty
            ];

            $total += ($product->getPrice() * $qty);
        }

        //dd($detaileCart);

        return $this->render('cart/index.html.twig', [
            'items' => $detaileCart,
            'total' => $total
        ]);
    }

Mise en place du template de cart index.html.twig

{% extends 'base.html.twig' %}

{% block title %}Votre panier
{% endblock %}

{% block body %}
	<h1>Votre panier</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Produit</th>
				<th>Prix</th>
				<th>Quantité</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			{% for item in items %}
				<tr>
					<td>
						{{ item.product.name }}
					</td>
					<td>{{ item.product.price }}</td>
					<td>{{ item.qty }}</td>
					<td>{{ item.qty * item.product.price }}</td>
				</tr>
			{% endfor %}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">Total :</td>
				<td>{{ total }}</td>
			</tr>
		</tfoot>
	</table>
{% endblock %}

Mise en place dans _navbar.thml.twig de l'icone Panier et de c'est fonctionalité.

<li class="nav-item">
	<a href="{{ path('cart_show') }}" class="nav-link">
		<i class="fas fa-shopping-cart"></i>
		Panier
	</a>
</li>

<h3>Premier récapitulatif</h3>
Pour Obtenir la Session et travailler dessus ont utilise

HttpFondation, la request ou la session.
Ou on peu se faire livrer la SessionInterface avec l'ArgumentResolver dans une méthode liée à une Route.
Mais on peu aussi de le faire livrée par le constructeur, par le contenaire dans le constructeurs de nos classes.
L'organisation de la Session
$session->set('nom', $valeur)
$session->get('nom', 'defaut')
Les informations sont rangées dans des bags en sac comme le FlashBag qui permet d'afficher des messages qui une fois 
lue disparaisse. Permet de créer des notifications pour le navigateur.


<h3>Refactoring : Créer un CartService qui embarque toute la gestion du panier</h3>

Creation dans le dossier src un fichier CartService.php.

Dans le quel nous allons créer la gestion du cart, le controller etant juste la pour contoler les infos
et verifier que les élèment sont la et pouvoir les affichées sur le twig.

<?php

namespace App\Cart;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    public function add(int $id)
    {
        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $this->session->get('cart', []);

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++; //si le produit est déjà en panier il ajouterat +


        } else {
            $cart[$id] = 1; // Si le produit n'est pas dans le panier il metrat 1
        }

        // 6. Enregistrer le tableau mis à jour dans la session
        $this->session->set('cart', $cart);
    }
    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->session->get('cart', []) as $id => $qty) {
            $product = $this->productRepository->find($id);

            $total += $product->getPrice() * $qty;
        }

        return $total;
    }

    public function getDetailedCartItems(): array
    {
        $detaileCart = [];


        foreach ($this->session->get('cart', []) as $id => $qty) {
            $product = $this->productRepository->find($id);
            $detaileCart[] = [
                'product' => $product,
                'qty' => $qty
            ];
        }

        return $detaileCart;
    }
}

Maintenant le CartController.php utilise l'appel au CartService pour le fonctionnement.

<?php

namespace App\Controller;

use App\Cart\CartService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    /**
     * //requirements={"id":"\d+"} permet d'imposé l'appel d'un nombre.
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, ProductRepository $productRepository, CartService $cartService): Response
    {

        // 0. Securisation: est-ce que le produit existe ?
        $product = $productRepository->find($id);


        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        $cartService->add($id);

        $this->addFlash('success', "Le produit a bien été ajouté au panier");

        // Supression de cart
        //$request->getSession()->remove('cart');

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show(CartService $cartService)
    {


        $detaileCart = $cartService->getDetailedCartItems();

        $total = $cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'items' => $detaileCart,
            'total' => $total
        ]);
    }
}

<h3>Refactoring : créer une classe qui représente un élément du panier</h3>

Creation dans le dossier src un fichier CartItem.php
Dans se fichier nous gérerons le total calculé. Mais l'avantage est que grace à cette amelioration 
nous pouvons géré d'autre chose comme les bons de reduction ......

<?php

namespace App\Cart;

use App\Entity\Product;

class CartItem
{
    public $product;
    public $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    public function getTotal(): int
    {
        return $this->product->getPrice() * $this->qty;
    }
}

Puis dans le dossier templates->cart du index.html.

{% extends 'base.html.twig' %}

{% block title %}Votre panier
{% endblock %}

{% block body %}
	<h1>Votre panier</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Produit</th>
				<th>Prix</th>
				<th>Quantité</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			{% for item in items %}
				<tr>
					<td>
						{{ item.product.name }}
					</td>
					<td>{{ item.product.price }}</td>
					<td>{{ item.qty }}</td>
                    // Plus aucun calcule dans le fichier twig il suffit d'appeler item.total
					<td>{{ item.total }}</td>
				</tr>
			{% endfor %}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">Total :</td>
				<td>{{ total }}</td>
			</tr>
		</tfoot>
	</table>
{% endblock %}

<h3>Rendre le CartService disponible dans nos templates Twig</h3>

Pour rendre CartService disponible partout il suffit de le déclaré dans le twig.yaml du dossier config->packages.

twig:
    default_path: "%kernel.project_dir%/templates"
    form_themes:
        - bootstrap_4_layout.html.twig
    globals:
        categoryRepository: "@App\\Repository\\CategoryRepository"
        cartService: "@App\\Cart\\CartService"


Maintenant nous pouvons l'utilisé ou on le souhaite comme dans la _navbar.html.twig

<ul class="navbar-nav">
	<li class="nav-item">
		<a href="{{ path('cart_show') }}" class="nav-link">
			<i class="fas fa-shopping-cart"></i>
            //utilisation du cartService pour afficher le total du panier
			Panier ({{ cartService.total }})
		</a>
	</li>

<h3>Finalisations : incrémenter, décrémenter, supprimer les éléments du panier</h3>

Dans le CartController.php nous allons créer des routes pour incrémenter, décrémenter, supprimer 
les éléments du panier

    /**
     * //Supression du product "\d+" retourne un nombre
     *
     * @Route("/cart/delete/{id}", name="cart_delete", requirements={"id": "\d+"})
     */
    public function delete($id, ProductRepository $productRepository, CartService $cartService)
    {
        $product = $productRepository->find($id);
        //Si le produit n'existe pas alors il retourne un message.
        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être suprimé ! ");
        }
        //Supression du produis
        $cartService->remove($id);
        //Message de success quand la suppression à bien était realisée
        $this->addFlash("success", "Le produit a bien été suprimé du panier");
        //Une fois terminé il retourne à la route carte_show.
        return $this->redirectToRoute("cart_show");
    }
Dans le CartService.php cration de la function de supression du produit.
La fonction var verifier que le produit existe et elle vas le suprimer.

public function remove(int $id)
    {
        //On vas recupérer un cart dans la session et si il n'y a rien tu retourne un tableau vide.
        $cart = $this->session->get('cart', []);
        //supression du produit de la cart id
        unset($cart[$id]);
        //Maintenant on veux le mettre à jour dans la session
        $this->session->set('cart', $cart);
    }

Dans l'index.html.twig de cart nous devons rajouter un <th></th>
et le boutons pour la supression.

<td>
    //On demande d'afficher la route cart_delete et l'identifiant du produit que l'on veux supprimer.
	<a href="{{ path("cart_delete", {'id': item.product.id}) }}" class="btn btn-sm btn-danger">
		<i class="fas fa-trash"></i>
	</a>
</td>

Dans le CartController.php nous allons créer des routes pour décrémenter

    /**
     * //Decrementation du produit
     * 
     * @Route("/cart/decrement/{id}", name="cart_decrement", requirements={"id": "\d+"})
     */
    public function decrement($id, cartService $cartService, ProductRepository $productRepository)
    {

        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être décrémenté ! ");
        }

        $cartService->decrement($id);

        $this->addFlash("success", "Le produit a bien été décrémenté");

        return $this->redirectToRoute("cart_show");
    }
}

Dans le CartService.php cration de la function de decrement du produit.

public function decrement(int $id)
    {

        $cart = $this->session->get('cart', []);

        // Si le produit n'exite pas il n'y rien à faire.
        if (!array_key_exists($id, $cart)) {
            return;
        }

        //soit le produit est à 1 ,alors il faut simplement le suprimer
        if ($cart[$id] === 1) {
            $this->remove($id);
            return;
        }

        //soit le produit est à plus de 1, alors il faut décrémenter
        $cart[$id]--;

        //Maintenant on veux le mettre à jour dans la session
        $this->session->set('cart', $cart);
    }

Dans l'index.html.twig de cart nous devons rajouter deux boutons pour la + et -.
{% extends 'base.html.twig' %}

{% block title %}Votre panier
{% endblock %}

{% block body %}
	<h1>Votre panier</h1>
	{% if items | length > 0 %}
		<table class="table">
			<thead>
				<tr>
					<th>Produit</th>
					<th>Prix</th>
					<th>Quantité</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{% for item in items %}
					<tr>
						<td>
							{{ item.product.name }}
						</td>
						<td>{{ item.product.price }}</td>
                        //Creation des boutons + et -mise en place de ?returnToCart=true permetra de revenir à notre panier.
						<td>
							<a href="{{ path("cart_add", {'id': item.product.id}) }}?returnToCart=true" class="btn btn-sm btn-primary">
								<i class="fas fa-plus"></i>
							</a>
							{{ item.qty }}
							<a href="{{ path("cart_decrement", {'id': item.product.id}) }}" class="btn btn-sm btn-primary">
								<i class="fas fa-minus"></i>
							</a>
						</td>
						<td>{{ item.total }}</td>
						<td>
							<a href="{{ path("cart_delete", {'id': item.product.id}) }}" class="btn btn-sm btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
				{% endfor %}
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">Total :</td>
					<td colspan="2">{{ total }}</td>
				</tr>
			</tfoot>
		</table>
	{% else %}
		<h2>Le panier est vide !</h2>
	{% endif %}
{% endblock %}

Donc dans CartController.php integration de l'exception returnToCart.

    /**
     * //requirements={"id":"\d+"} permet d'imposé l'appel d'un nombre.
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, ProductRepository $productRepository, CartService $cartService, Request $request): Response
    {

        // 0. Securisation: est-ce que le produit existe ?
        $product = $productRepository->find($id);


        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        $cartService->add($id);

        $this->addFlash('success', "Le produit a bien été ajouté au panier");

        // Supression de cart
        //$request->getSession()->remove('cart');

        //Si dans l'url il y a un point d'interogation returnToCart 
        if ($request->query->get('returnToCart')) {
            //alors ont sera rediriger sur cart_show
            return $this->redirectToRoute("cart_show");
        }
        //Mais si je n'ai pas l'information je retourne ici
        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

Creation du message si il n'y a pas de produit dans l'index.html.twig de cart.

{% extends 'base.html.twig' %}

{% block title %}Votre panier
{% endblock %}

{% block body %}
	<h1>Votre panier</h1>
    // dans le items on le fait passer dans le filtre length et supperieur à zero.
	{% if items | length > 0 %}
		<table class="table">
			<thead>
				<tr>
					<th>Produit</th>
					<th>Prix</th>
					<th>Quantité</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{% for item in items %}
					<tr>
						<td>
							{{ item.product.name }}
						</td>
						<td>{{ item.product.price }}</td>
						<td>
							<a href="{{ path("cart_add", {'id': item.product.id}) }}?returnToCart=true" class="btn btn-sm btn-primary">
								<i class="fas fa-plus"></i>
							</a>
							{{ item.qty }}
							<a href="{{ path("cart_decrement", {'id': item.product.id}) }}" class="btn btn-sm btn-primary">
								<i class="fas fa-minus"></i>
							</a>
						</td>
						<td>{{ item.total }}</td>
						<td>
							<a href="{{ path("cart_delete", {'id': item.product.id}) }}" class="btn btn-sm btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
				{% endfor %}
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">Total :</td>
					<td colspan="2">{{ total }}</td>
				</tr>
			</tfoot>
		</table>
        //Sinon on affiche le message suivant.
	{% else %}
		<h2>Le panier est vide !</h2>
	{% endif %}
{% endblock %}

<h3>Refactoring du CartService</h3>
Dans le CartController.php il est encore possible de faire du refactoring.
Pour reduire l'appel sur chaque function de ProductRepository $productRepository, CartService $cartService.
Il faut créer un constructeur .

<?php

namespace App\Controller;

use App\Cart\CartService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{
    //appel de ProductRepository et CartService.
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CartService
     */
    protected $cartService;

    public function __construct(ProductRepository $productRepository, CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
    }

    /**
     * //requirements={"id":"\d+"} permet d'imposé l'appel d'un nombre.
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, Request $request): Response
    {

        // 0. Securisation: est-ce que le produit existe ?
        $product = $this->productRepository->find($id);


        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        $this->this->cartService->add($id);

        $this->addFlash('success', "Le produit a bien été ajouté au panier");

        // Supression de cart
        //$request->getSession()->remove('cart');

        //Si dans l'url il y a un point d'interogation returnToCart 
        if ($request->query->get('returnToCart')) {
            //alors ont sera rediriger sur cart_show
            return $this->redirectToRoute("cart_show");
        }

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show()
    {


        $detaileCart = $this->cartService->getDetailedCartItems();

        $total = $this->cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'items' => $detaileCart,
            'total' => $total
        ]);
    }

    /**
     * //Supression du product
     *
     * @Route("/cart/delete/{id}", name="cart_delete", requirements={"id": "\d+"})
     */
    public function delete($id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être suprimé ! ");
        }

        $this->cartService->remove($id);

        $this->addFlash("success", "Le produit a bien été suprimé du panier");

        return $this->redirectToRoute("cart_show");
    }

    /**
     * //Decrementation du produit
     * 
     * @Route("/cart/decrement/{id}", name="cart_decrement", requirements={"id": "\d+"})
     */
    public function decrement($id)
    {

        $product = $this->productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être décrémenté ! ");
        }

        $this->cartService->decrement($id);

        $this->addFlash("success", "Le produit a bien été décrémenté");

        return $this->redirectToRoute("cart_show");
    }
}

refactoring
Pour le CratService.php creation de la fonction function getCart() et saveCart(array $cart)

    //GetCart nous revois un tableau
    protected function getCart(): array
    {
        //queque ma session me retourne en get un tableau vide.
        return $this->session->get('cart', []);
    }
    //Setcart qui recevera un tableau $cart
    protected function saveCart(array $cart)
    {
        //Qui retourne dans la session un tableau $cart
        $this->session->set('cart', $cart);
    }

Cela permet d'eviter des repetion dans les lignes maintenant on peu appeler directement.
$cart = $this->getCart(); et $this->saveCart($cart);
public function add(int $id)
    {
        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $this->getCart();

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        if (array_key_exists($id, $cart)) {
            $cart[$id]++; //si le produit est déjà en panier il ajouterat +


        } else {
            $cart[$id] = 1; // Si le produit n'est pas dans le panier il metrat 1
        }

        // 6. Enregistrer le tableau mis à jour dans la session
        $this->saveCart($cart);
    }

    public function getDetailedCartItems(): array
    {
        $detaileCart = [];


        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            //Si un produit à était suprimé, il continurat la boucle.
            if (!$product) {
                continue;
            }

            $detaileCart[] = new CartItem($product, $qty);
        }

        return $detaileCart;
    }

Pour eviter d'utiliser le else du if dans le CartService.php, nous pouvont encore simplifier.

public function add(int $id)
    {
        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $this->getCart();

        //attention si sa n'existe pas il reste a zero
        if (!array_key_exists($id, $cart)) {
            $cart[$id] = 0; //si le produit est déjà en panier il ajouterat +

        }
        //Si il exite il passera au nombre superieur.
        $cart[$id]++; // Si le produit n'est pas dans le panier il metrat 1
        

        // 6. Enregistrer le tableau mis à jour dans la session
        $this->saveCart($cart);
    }

<h3>📖 Conclusion</h3>
Comment recupérérer la session ? Via le HttpFondation, la Request on aura accés à la session.
Ont peu aussi se le faire livrée dans un controller ou dans une classe au niveau du constructeur.

SessionInterface
-Par l'ArgumentResolver dans un méthode liée à une Route.
-Par le Container dans vos constructeurs.
Les sessions sont livréer par différent Bags, les information sont rangées dans des Bags.
_sf2_attributes (attributes) on n'y range les donées et le bags des flashes pour posé des messages de notification au utilisateur.

Refactoring et POO
Redistribuer les responsabilités entre différents acteurs
-CartService
-CarteItem

<h2>Commandes : Doctrine et ManyToMany (1 heure et 45 minutes)</h2>
Etudions les associations "complexes" de doctrine. Des relation de plurieur à plusieur.
Dans cette partie nous allons traitait les relations de plusieur à plusieur.
ManyToMany, créer l'entity "Purchase".
Voir quelles informations ? à quelles autre entityté elle est relier ou associer ?
Nous allons faire une revision et voir avec quelle outil nous allons utilisé dans le contenaire de sevice.
Ainsi prendre les bonne pratique du code pour eviter une trop grande quantité de code.
Essayons de tendre vers un code propre et maintenable en différente class.

<h3>Créer l'entité Purchase (commande)</h3>
php bin/console make:entity Purchase
Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > FullName

 Field type (enter ? to see all types) [string]:
 > 


 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > address

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > postalCode

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > city

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > total

 Field type (enter ? to see all types) [string]:
 > integer
intege
r

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > status

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > ?
?

Main types
  * string
  * text
  * boolean
  * integer (or smallint, bigint)
  * float

Relationships / Associations
  * relation (a wizard will help you build the relation)
  * ManyToOne
  * OneToMany
  * ManyToMany
  * OneToOne

Array/Object Types
  * array (or simple_array)
  * json
  * object
  * binary
  * blob

Date/Time Types
  * datetime (or datetime_immutable)
  * datetimetz (or datetimetz_immutable)
  * date (or date_immutable)
  * time (or time_immutable)
  * dateinterval

Other Types
  * ascii_string
  * decimal
  * guid
  * json_array


 Field type (enter ? to see all types) [string]:
 > ManyToOne
ManyToOne
;49m
 What class should this entity be related to?:
 > User
User

 Is the Purchase.user property allowed to be null (nullable)? (yes/no) [yes]:
 >

 Do you want to add a new property to User so that you can access/update Purchase objects from it -
 e.g. $user->getPurchases()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related Purchase objects from it.

 New field name inside User [purchases]:
 >

 updated: src/Entity/Purchase.php

Dans l'entity Purchase.php nous modifions le status pour que quand il n'est pas renseigner.

class Purchase
{
    //Pour eviter de chercher les différent status dans les codes,
    //nous creont deux public const.
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PAID = 'PAID';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = 'PENDING';
    //On rajoute pending quand le status n'est pas renseigner il sera en attente.

Mise en place de la datafixtures dans AppFixtures.php
Pour la creation des différentes commande en automatique.

        // Creation d'un tableau vide Users pour le purchase
        $users = [];

        //Boucle for si $u = 0 et si $u < 5 alors tu fais $u++
        for ($u = 0; $u < 5; $u++) {
            $user = new User();

            $hash = $this->encoder->encodePassword($user, "passeword");

            $user->setEmail("user$u@gmail.com")
                ->setFullName($faker->name())
                ->setPassword($hash);

            // A chaque fois que je vais faire une boucle je vais rajouter 5 user au tableau
            $users[] = $user;

            $manager->persist($user);
        }

        for ($p = 0; $p < mt_rand(20, 40); $p++) {
            $purchase = new Purchase;

            $purchase->setFullName($faker->name)
                ->setAddress($faker->streetAddress)
                ->setPostalCode($faker->postcode)
                ->setCity($faker->city)
                ->setUser($faker->randomElement($users))
                ->setTotal(mt_rand(2000, 30000));

            if ($faker->boolean(90)) {
                $purchase->setStatus(Purchase::STATUS_PAID);
            }

            $manager->persist($purchase);
        }
Injection de la fixture. 
php bin/console d:f:l --no-interaction

<h3>Afficher la liste des commandes d'un utilisateur</h3>

Creation dans template du dossier purchase et fichier index.html.twig   

{% extends "base.html.twig" %}

{% block title %}
	Mes commandes
{% endblock %}

{% block body %}
	<h1>Mes commandes</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Numéro</th>
				<th>Adresse</th>
				<th>Date de commande</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			{% for p in purchases %}
				<tr>
					<td>
						{{ p.id }}
					</td>
					<td>
						{{ p.address }}<br>{{ p.postalCode }},
						{{ p.city }}
					</td>
					<td>TODO</td>
					<td>{{ p.total / 100 }}
						€
					</td>
				</tr>
			{% endfor %}

		</tbody>
	</table>
{% endblock %}

Mise en place dans la _navbar.html.twig.

<li class="nav-item">
	<a herf="#" class="nav-link">Mes commandes</a>
</li>


Pour une bonne pratique nous allons créer dans le dossier controller un dossier Purchase 
puis un fichier PurchaseListController.php qui permetrat de gére les commandes
Dans un premier temp créer le controller pour afficher la liste des commandes.
Petit revision sur le fonctionnement.

<?php

namespace App\Controller\Purchase;

use Twig\Environment;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PurchasesListController extends AbstractController
{
    protected $security;
    protected $router;
    protected $twig;

    public function __construct(Security $security, RouterInterface $router, Environment $twig)
    {
        $this->security = $security;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @Route("/purchases", name="purchase_index")
     */
    public function index()
    {
        //1.Nous devons nous assurer que la personne est connectée (sinon retour à la page d'acceuil).->Security

        /** @var User */
        $user = $this->security->getUser();

        if (!$user) {
            //Redirction -> RedirectResponse
            //Générer une URL en fontion du nom d'une route ->UrlGeneratorInterface ou le RouterInterface
            //$url = $this->router->generate('homepage');
            //return new RedirectResponse($url);
            throw new AccessDeniedException("Vous devez être connecté pour accéder à vos commandes");
        }
        //2. Nous voulons savoir qui est connecter.->Security

        //3. Nous voulons passer l'utilisateur connecté à twig afin d'afficher ces commande. Environement de Twig/Response
        $html = $this->twig->render('purchase/index.html.twig', [
            'purchases' => $user->getPurchases()
        ]);

        return new Response($html);
    }
}

<h3>Ajouter une date de commande et gérer les problèmes de migration</h3>

php bin/console make:entity Purchase

 Your entity already exists! So let's add some new fields!

//Le faite de rajouté At a purchase, il est detecter un date time.

 New property name (press <return> to stop adding fields):
 > purchasedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > 


 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):

Suite à une erreur lors de la migration car des donnée sont déjà existante dans la bdd.
Car il ne peu prendre de date null.

php bin/console doctrine:migrations:migrate

 WARNING! You are about to execute a migration in database "symshop" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
 > yes

[notice] Migrating up to DoctrineMigrations\Version20211103172945
[error] Migration DoctrineMigrations\Version20211103172945 failed during Execution. Error: "An exception occurred while executing 'ALTER TABLE purchase ADD purchase_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)'':

SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: '0000-00-00 00:00:00' for column 'purchase_at' at row 1"

In AbstractMySQLDriver.php line 128:
                                                                                                                                          
  An exception occurred while executing 'ALTER TABLE purchase ADD purchase_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)'':        
                                                                                                                                          
  SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: '0000-00-00 00:00:00' for column 'purchase_at' at row 1              
                                                                                                                        
In Exception.php line 18:

  SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: '0000-00-00 00:00:00' for column 'purchase_at' at row 1  

In PDOConnection.php line 132:

  SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: '0000-00-00 00:00:00' for column 'purchase_at' at row 1  

doctrine:migrations:migrate [--write-sql [WRITE-SQL]] [--dry-run] [--query-time] [--allow-no-migration] [--all-or-nothing [ALL-OR-NOTHING]] [--configuration CONFIGURATION] [--em EM] [--conn CONN] [-h|--help] [-q|--quiet] [-v|vv|vvv|--verbose] [-V|--version] [--ansi] [--no-ansi] [-n|--no-interaction] [-e|--env ENV] [--no-debug] [--] <command> [<version>]

Il faut modifier le fichier de migration Version20211103172945.
Pour qu'il puisse méttre à jour la base existante et revenir a des date non null.

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103172945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase ADD purchased_at DATETIME NOT NULL');
        //Mise à jours de la base de donné déjà intégrer.
        $this->addSql('UPDATE purchase SET purchased_at = NOW()');
        //Mise en place de la base de donné avec le date time no null.
        $this->addSql('ALTER TABLE purchase MODIFY purchased_at DATETIME NOT NULL');
    }

Maintenant dans la table purchase il y a bien les dates et les dates seront en NOT NULL.

Dans le dataFixtures du fichier AppFixtures.php il faut metre en place le dateTime.

        for ($p = 0; $p < mt_rand(20, 40); $p++) {
            $purchase = new Purchase;

            $purchase->setFullName($faker->name)
                ->setAddress($faker->streetAddress)
                ->setPostalCode($faker->postcode)
                ->setCity($faker->city)
                ->setUser($faker->randomElement($users))
                ->setTotal(mt_rand(2000, 30000));
                ->setPurchasedAt($faker->dateTimeBetween('-6 months'));

            if ($faker->boolean(90)) {
                $purchase->setStatus(Purchase::STATUS_PAID);
            }

            $manager->persist($purchase);
        }

Migration de la fixture.
php bin/console d:f:l --no-interaction

Mise en place de purchasedAt dans le dossier purchase du fichier index.html.twig

        <tbody>
			{% for p in purchases %}
				<tr>
					<td>
						{{ p.id }}
					</td>
					<td>
						{{ p.address }}<br>{{ p.postalCode }},
						{{ p.city }}
					</td>
					<td>
						{{ p.purchasedAt | date('d/m/y H:i') }}
					</td>
					<td>{{ p.total / 100 }}
						€
					</td>
				</tr>
			{% endfor %}

		</tbody>

<h3>Relation ManyToMany entre Purchase et Product<h3>
Creation d'un listing des commandes qui sont lier à des produits
Creation de la relation entre Product et Purchase.
php bin/console make:entity Purchase

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > products

 Field type (enter ? to see all types) [string]:
 > ManyToMany
ManyToOne
Many

 What class should this entity be related to?:
 > product
product

 Do you want to add a new property to product so that you can access/update Purchase objects from it - e.g
. $product->getPurchases()? (yes/no) [yes]:
 > 
 
 A new property will also be added to the product class so that you can access the related Purchase objects from it.

 >
 updated: src/Entity/Purchase.php
 updated: src/Entity/Product.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >        
  Success! 

Cela a créer dans les entity Product et Purchase

Product

    /**
     * @ORM\ManyToMany(targetEntity=Purchase::class, mappedBy="products")
     */
    private $purchases;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

 Purchase

    /**
     * @ORM\ManyToMany(targetEntity=product::class, inversedBy="purchases")
     */
    private $products;

Avec tout leurs sevices get et set.    

Une fois la migration Version20211103192450.php effectuer, 

Il créer une table purchase_product

Mise en place de la fixture dans l'AppFicture.php 

//Creation d'un tableau vide $products.
$products = [];

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

                //et a chaque nouveau produit rajouter dans $products 
                $products[] = $product;

                // je persit 100 produit
                $manager->persist($product);
            }
        }

        for ($p = 0; $p < mt_rand(20, 40); $p++) {
            $purchase = new Purchase;

            $purchase->setFullName($faker->name)
                ->setAddress($faker->streetAddress)
                ->setPostalCode($faker->postcode)
                ->setCity($faker->city)
                ->setUser($faker->randomElement($users))
                ->setTotal(mt_rand(2000, 30000))
                ->setPurchasedAt($faker->dateTimeBetween('-6 months'));

            //je vais allé chercher une selection de produit et avec faker je veux aller recupérer plusieur élèment
             et aller chercher au asart 3 à 5 produit.
            $selectedProducts = $faker->randomElements($products, mt_rand(3, 5));
            //pour chacun des $selectedProducts de product.
            foreach ($selectedProducts as $product) {
                $purchase->addProduct($product);
            }


            if ($faker->boolean(90)) {
                $purchase->setStatus(Purchase::STATUS_PAID);
            }

            $manager->persist($purchase);
        }

Dans l'index.html.twig de purchase.

{% block body %}
	<h1>Mes commandes</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Numéro</th>
				<th>Adresse</th>
				<th>Date de commande</th>
                //rajout de produit
				<th>Produits</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			{% for p in purchases %}
				<tr>
					<td>
						{{ p.id }}
					</td>
					<td>
						{{ p.address }}<br>{{ p.postalCode }},
						{{ p.city }}
					</td>
					<td>
						{{ p.purchasedAt | date('d/m/y H:i') }}
					</td>
                    //creation du td de pour afficher la liste de produit.
					<td>
						<ul>
							{% for product in p.products %}
								<li>
									{{ product.name }}
									({{ product.price / 100 }}
									€)</li>
							{% endfor %}
						</ul>
					</td>
					<td>{{ p.total / 100 }}
						€
					</td>
				</tr>
			{% endfor %}

		</tbody>
	</table>
{% endblock %}

<h3>Refactoring de la liste de commandes</h3>

Pour le PurchasesListController.php il y a plus simple pour acceder au donné.
Ancien PurchasesListController.php

<?php

namespace App\Controller\Purchase;

use Twig\Environment;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PurchasesListController extends AbstractController
{
    protected $security;
    protected $router;
    protected $twig;

    public function __construct(Security $security, RouterInterface $router, Environment $twig)
    {
        $this->security = $security;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @Route("/purchases", name="purchase_index")
     */
    public function index()
    {
        //1.Nous devons nous assurer que la personne est connectée (sinon retour à la page d'acceuil).->Security

        /** @var User */
        $user = $this->security->getUser();

        if (!$user) {
            //Redirction -> RedirectResponse
            //Générer une URL en fontion du nom d'une route ->UrlGeneratorInterface ou le RouterInterface
            //$url = $this->router->generate('homepage');
            //return new RedirectResponse($url);
            throw new AccessDeniedException("Vous devez être connecté pour accéder à vos commandes");
        }
        //2. Nous voulons savoir qui est connecter.->Security

        //3. Nous voulons passer l'utilisateur connecté à twig afin d'afficher ces commande. Environement de Twig/Response
        $html = $this->twig->render('purchase/index.html.twig', [
            'purchases' => $user->getPurchases()
        ]);

        return new Response($html);
    }
}

En utilisant l'AbstractController nous n'avon pas besion de grand chose pour faire la méme 
mécanique.

<?php

namespace App\Controller\Purchase;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasesListController extends AbstractController
{
    //Comme on érite de l'AbstractController nous avons plus besion du constructer.
    /**
     * @Route("/purchases", name="purchase_index")
     * //Pour remplacer le if(!user) vue dans le chapitre La session dans Symfony 5 (1 heure et 30 minutes)
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour accéder à vos commandes")
     */
    public function index()
    {
        //1.Nous devons nous assurer que la personne est connectée (sinon retour à la page d'acceuil).->Security

        /** @var User */
        $user = $this->getUser();


        //2. Nous voulons savoir qui est connecter.->Security
        //3. Nous voulons passer l'utilisateur connecté à twig afin d'afficher ces commande. Environement de Twig/Response
        return $this->render('purchase/index.html.twig', [
            'purchases' => $user->getPurchases()
        ]);
    }
}

<h3>Créer une ManyToMany avec des informations supplémentaires<h3>
La relation utiliser au par avant ne convient pas car on ne peux pas savoir combien de produit sont commandés, par commande.

Dans le dossier Entity du fichier Product.php il faut suprimer tout se qui conserne Purchase
<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Le stock doit être renseigné !")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message="La photo pricipale doit être une URL valide")
     * @Assert\NotBlank(message="La photo principal est obligatoire")
     */
    private $mainPicture;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="La description courte est obligatoire")
     * @Assert\Length(min=20, minMessage="La description courte doit quand même faire au moins 20 caractéres")
     */
    private $shortDescription;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getMainPicture(): ?string
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?string $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }
}

Dans le dossier Entity du fichier Purchase.php il faut suprimer tout se qui conserne Product

<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PurchaseRepository::class)
 */
class Purchase
{
    //Pour eviter de chercher les différent status dans les codes,
    //nous creont deux public const.
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PAID = 'PAID';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = 'PENDING';
    //On rajoute pending quand le status n'est pas renseigner il sera en attente.

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="purchases")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $purchasedAT;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->FullName;
    }

    public function setFullName(string $FullName): self
    {
        $this->FullName = $FullName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPurchasedAT(): ?\DateTime
    {
        return $this->purchasedAT;
    }

    public function setPurchasedAt(\DateTime $purchasedAT): self
    {
        $this->purchasedAT = $purchasedAT;

        return $this;
    }
}

Aprés il suffit de suprimé la table dirrectement dans le terminal.

Avec la commande suivante.
php bin/console make:migration

puis 

php bin/console doctrine:migrations:migrate

La dans la base de donnée le purchase_product à disparue.

Pour pouvoir avoir une visibilitée sur la commande nous allons créer une nouvelle entity

php bin/console make:entity PurchaseItem   

 created: src/Entity/PurchaseItem.php
 created: src/Repository/PurchaseItemRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > product

 Field type (enter ? to see all types) [string]:
 > ManyToOne
ManyToOne
One

 What class should this entity be related to?:
 > Product
Product
47mt
 Is the PurchaseItem.product property allowed to be null (nullable)? (yes/no) [yes]:
 >

 Do you want to add a new property to Product so that you can access/update PurchaseItem objects from it -
 e.g. $product->getPurchaseItems()? (yes/no) [yes]:
 > 

 A new property will also be added to the Product class so that you can access the related PurchaseItem objects from it.

 New field name inside Product [purchaseItems]:
 >

 updated: src/Entity/PurchaseItem.php
 updated: src/Entity/Product.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > purchase

 Field type (enter ? to see all types) [string]:
 > ManyToOne
ManyToOne
One

 What class should this entity be related to?:
 > Purchase
Purchase
se
 Is the PurchaseItem.purchase property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to Purchase so that you can access/update PurchaseItem objects from it 
- e.g. $purchase->getPurchaseItems()? (yes/no) [yes]:
 >

 A new property will also be added to the Purchase class so that you can access the related PurchaseItem objects from it.

 New field name inside Purchase [purchaseItems]:
 >

 Do you want to activate orphanRemoval on your relationship?
 A PurchaseItem is "orphaned" when it is removed from its related Purchase.
 e.g. $purchase->removePurchaseItem($purchaseItem)

 NOTE: If a PurchaseItem may *change* from one Purchase to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\PurchaseItem objects (orphanRemoval)? (yes/no) [no]:  
 > yes

 updated: src/Entity/PurchaseItem.php
 updated: src/Entity/Purchase.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > productName

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/PurchaseItem.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > productPrice

 Field type (enter ? to see all types) [string]:
 > integer
integer
47mr
 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/PurchaseItem.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > Quantity

integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/PurchaseItem.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > total

 Field type (enter ? to see all types) [string]:
 > integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/PurchaseItem.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >
         
  Success! 
           
 Next: When you're ready, create a migration with php bin/console make:migration

 [WARNING] You have 1 previously executed migrations in the database that are not registered migrations.

 Are you sure you wish to continue? (yes/no) [yes]:
 > yes
 
  Success! 
 

 Next: Review the new migration "migrations/Version20211108091855.php"
 Then: Run the migration with php bin/console doctrine:migrations:migrate
 See https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
PS C:\laragon\www\Cours-ecommerce --version=5.1\cours-ecommerce> php bin/console doctrine:migrations:migrate

 WARNING! You are about to execute a migration in database "symshop" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
 > yes

 [WARNING] You have 1 previously executed migrations in the database that are not registered migrations.

 >> 2021-11-03 18:22:47 (DoctrineMigrations\Version20211103172945)

 Are you sure you wish to continue? (yes/no) [yes]:
 > yes

[notice] Migrating up to DoctrineMigrations\Version20211108091855
[notice] finished in 247.4ms, used 20M memory, 1 migrations executed, 3 sql queries

Voila une nouvelle entity créer purchase_item.

Maintenant il faut créer la fixture pour le purchase_item.

        for ($p = 0; $p < mt_rand(20, 40); $p++) {
            $purchase = new Purchase;

            $purchase->setFullName($faker->name)
                ->setAddress($faker->streetAddress)
                ->setPostalCode($faker->postcode)
                ->setCity($faker->city)
                ->setUser($faker->randomElement($users))
                ->setTotal(mt_rand(2000, 30000))
                ->setPurchasedAt($faker->dateTimeBetween('-6 months'));

            $selectedProducts = $faker->randomElements($products, mt_rand(3, 5));

            // Modification de la creation du foreach pour la création des fixtures purchaseItem
            foreach ($selectedProducts as $product) {
                $purchaseItem = new PurchaseItem;
                $purchaseItem->setProduct($product)
                    ->setQuantity(mt_rand(1, 3))
                    ->setProductName($product->getName())
                    ->setProductPrice($product->getPrice())
                    ->setTotal(
                        $purchaseItem->getProductPrice() * $purchaseItem->getQuantity()
                    )
                    ->setPurchase($purchase);
                    
                $manager->persist($purchaseItem);    
            }
            if ($faker->boolean(90)) {
                $purchase->setStatus(Purchase::STATUS_PAID);
            }

            $manager->persist($purchase);
        }

Injection de la fixture:

php bin/console d:f:l --no-interaction

Il faut que tout les information soit visible sur notre formulaire purchase dans le index.html.twig

{% extends "base.html.twig" %}

{% block title %}
	Mes commandes
{% endblock %}

{% block body %}
	<h1>Mes commandes</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Numéro</th>
				<th>Adresse</th>
				<th>Date de commande</th>
				<th>Produits</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			{% for p in purchases %}
				<tr>
					<td>
						{{ p.id }}
					</td>
					<td>
						{{ p.address }}<br>{{ p.postalCode }},
						{{ p.city }}
					</td>
					<td>
						{{ p.purchasedAt | date('d/m/y H:i') }}
					</td>
					<td>
						<ul>
                            //appel des composesant de notre commande.
							{% for item in p.purchaseItems %}
								<li>
									{{ item.quantity}}
									x
									{{ item.productName }}
									({{ item.total / 100 }}
									€)</li>
							{% endfor %}
						</ul>
					</td>
					<td>{{ p.total / 100 }}
						€
					</td>
				</tr>
			{% endfor %}

		</tbody>
	</table>
{% endblock %}

<h3>📖 Premier récapitulatif</h3>

ManyToMany: Récapitulatif.

Permet de voir des relation de plusieur à plusieur qui sont porteuse d'information.

   product
------------
     Id

purchase_product
-----------------
    purchase_id
    product_id
    quantity
    productName
    total

  purchase
-----------
    id

Doctrine detecte que nous navons pas besoin d'entity pour la représentés.

Mais pour pouvoir le représenté dans notre code nous avons besoin d'une entity.
Si on pense q'une relation de plusieur à plusieur ne porte pas d'information particuliére alors faire un ManyToMany.

Mais si vous pensé que la relation plusieur à plusieur, porte des informations crutial dans la base de donnér, exemple la quantity il faut passé par une entity qui fera le lien avec les entitées.

<h3>Formulaire de commande</h3>

php bin/console make:form CartConfirmationType

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 >


 created: src/Form/CartConfirmationType.php

 Creation dans le dossier form CartConfirmationType.php

 <?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('field_name')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

Creation du formulaire avec les informations concernant les commandes.
<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Nom complet',
                'attr' => [
                    'placeholder' => 'Nom complet pour la livraison'
                ]
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Address compléte',
                'attr' => [
                    'placeholder' => 'Adresse complète pour la livraison'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code Postal',
                'attr' => [
                    'placeholder' => 'Code postal pour la livraison'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'ville',
                'attr' => [
                    'placeholder' => 'Ville pour la livraison'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

Maintenant pour faire apparaitre les information dans la formulaire il faut allé dans le CartController.php

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show()
    {
        //appel de la class CartConfirmationType
        $form = $this->createForm(CartConfirmationType::class);

        $detaileCart = $this->cartService->getDetailedCartItems();

        $total = $this->cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'items' => $detaileCart,
            'total' => $total,
            //utilisation de confirmationForm
            'confirmationForm' => $form->createView()
        ]);
    }

Puis dans le dossier templates puis du dossier cart du fichier index.html.twig

{% extends 'base.html.twig' %}

{% block title %}Votre panier
{% endblock %}

{% block body %}
	<h1>Votre panier</h1>
	{% if items | length > 0 %}
		<table class="table">
			<thead>
				<tr>
					<th>Produit</th>
					<th>Prix</th>
					<th>Quantité</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{% for item in items %}
					<tr>
						<td>
							{{ item.product.name }}
						</td>
						<td>{{ item.product.price }}</td>
						<td>
							<a href="{{ path("cart_add", {'id': item.product.id}) }}?returnToCart=true" class="btn btn-sm btn-primary">
								<i class="fas fa-plus"></i>
							</a>
							{{ item.qty }}
							<a href="{{ path("cart_decrement", {'id': item.product.id}) }}" class="btn btn-sm btn-primary">
								<i class="fas fa-minus"></i>
							</a>
						</td>
						<td>{{ item.total }}</td>
						<td>
							<a href="{{ path("cart_delete", {'id': item.product.id}) }}" class="btn btn-sm btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
				{% endfor %}
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">Total :</td>
					<td colspan="2">{{ total }}</td>
				</tr>
			</tfoot>
		</table>
		<hr>
        //integration du formulaire de confirmation de commande.
		<h2>Confimez votre commande en remplissant ce formulaire</h2>
		{{ form_start(confirmationForm) }}

		{{ form_widget(confirmationForm) }}

		<button type="submit" class="btn btn-sucess">Je confirme !</button>

		{{ form_end(confirmationForm) }}

	{% else %}
		<h2>Le panier est vide !</h2>
	{% endif %}
{% endblock %}

<h3>Le Controller qui va gérer le formulaire (1/2)</h3>

Dans le PurchaseConfirmationController.php nous avons un probléme avec la route.

<?php

namespace App\Controller\Purchase;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseConfirmationController
{
    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     */
    public function confirm(): Response
    {
        return $this->render('$0.html.twig', []);
    }
}

Symfony la confond avec la route de ProductController.php.

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

Il considére que purchase et un produit et un slug dans le PurchaseConfirmationController.php

    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     */

Allons voir dans php bin/console debug:route

 Name                       Method     Scheme       Host   Path                               
 -------------------------- ---------- ------------ ------ -----------------------------------
  _preview_error             ANY        ANY          ANY    /_error/{code}.{_format}
  _wdt                       ANY        ANY          ANY    /_wdt/{token}
  _profiler_home             ANY        ANY          ANY    /_profiler/
  _profiler_search           ANY        ANY          ANY    /_profiler/search
  _profiler_search_bar       ANY        ANY          ANY    /_profiler/search_bar
  _profiler_phpinfo          ANY        ANY          ANY    /_profiler/phpinfo
  _profiler_search_results   ANY        ANY          ANY    /_profiler/{token}/search/results
  _profiler_open_file        ANY        ANY          ANY    /_profiler/open
  _profiler                  ANY        ANY          ANY    /_profiler/{token}
  _profiler_router           ANY        ANY          ANY    /_profiler/{token}/router
  _profiler_exception        ANY        ANY          ANY    /_profiler/{token}/exception
  _profiler_exception_css    ANY        ANY          ANY    /_profiler/{token}/exception.css
  calcul                     ANY        ANY          ANY    /calcul
  cart_add                   ANY        ANY          ANY    /cart/add/{id}
  cart_show                  ANY        ANY          ANY    /cart
  cart_delete                ANY        ANY          ANY    /cart/delete/{id}
  cart_decrement             ANY        ANY          ANY    /cart/decrement/{id}
  category_create            ANY        ANY          ANY    /admin/category/create
  category_edit              ANY        ANY          ANY    /admin/category/{id}/edit
  funcpage                   ANY        ANY          ANY    /function
  name                       ANY        ANY          ANY    /hello/{prenom}
  example                    ANY        ANY          ANY    /product/{$id}
  homepage                   ANY        ANY          ANY    /

  // On se rend compte que la route /{category_slug}/{slug} passe avant /purchase/confirm
  product_show               ANY        ANY          ANY    /{category_slug}/{slug}

  product_edit               ANY        ANY          ANY    /admin/product/{id}/edit
  product_create             ANY        ANY          ANY    /admin/product/create

// Donc symfony considére que /{category_slug}/{slug} et prioritaire
  purchase_confirm           ANY        ANY          ANY    /purchase/confirm

  purchase_index             ANY        ANY          ANY    /purchases
  security_login             ANY        ANY          ANY    /login
  security_logout            ANY        ANY          ANY    /logout
  index                      ANY        ANY          ANY    /
  test                       GET|POST   http|https   ANY    /test/{age}{prenom}
  product_category           ANY        ANY          ANY    /{slug}
 -------------------------- ---------- ------------ ------ -----------------------------------

Pour eviter cette problématique dans le ProductController.php nous mettons une priorité à la route à -1. 

    /**
     * @Route("/{category_slug}/{slug}", name="product_show", priority=-1)
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


Retournons voir dans php bin/console debug:route

-------------------------- ---------- ------------ ------ ----------------------------------- 
  Name                       Method     Scheme       Host   Path                               
 -------------------------- ---------- ------------ ------ ----------------------------------- 
  _preview_error             ANY        ANY          ANY    /_error/{code}.{_format}
  _wdt                       ANY        ANY          ANY    /_wdt/{token}
  _profiler_home             ANY        ANY          ANY    /_profiler/
  _profiler_search           ANY        ANY          ANY    /_profiler/search
  _profiler_search_bar       ANY        ANY          ANY    /_profiler/search_bar
  _profiler_phpinfo          ANY        ANY          ANY    /_profiler/phpinfo
  _profiler_search_results   ANY        ANY          ANY    /_profiler/{token}/search/results
  _profiler_open_file        ANY        ANY          ANY    /_profiler/open
  _profiler                  ANY        ANY          ANY    /_profiler/{token}
  _profiler_router           ANY        ANY          ANY    /_profiler/{token}/router
  _profiler_exception        ANY        ANY          ANY    /_profiler/{token}/exception
  _profiler_exception_css    ANY        ANY          ANY    /_profiler/{token}/exception.css
  calcul                     ANY        ANY          ANY    /calcul
  cart_add                   ANY        ANY          ANY    /cart/add/{id}
  cart_show                  ANY        ANY          ANY    /cart
  cart_delete                ANY        ANY          ANY    /cart/delete/{id}
  cart_decrement             ANY        ANY          ANY    /cart/decrement/{id}
  category_create            ANY        ANY          ANY    /admin/category/create
  category_edit              ANY        ANY          ANY    /admin/category/{id}/edit
  funcpage                   ANY        ANY          ANY    /function
  name                       ANY        ANY          ANY    /hello/{prenom}
  example                    ANY        ANY          ANY    /product/{$id}
  homepage                   ANY        ANY          ANY    /
  product_edit               ANY        ANY          ANY    /admin/product/{id}/edit
  product_create             ANY        ANY          ANY    /admin/product/create3

  // perchase et maintenant passé devant /{category_slug}/{slug}
  purchase_confirm           ANY        ANY          ANY    /purchase/confirm

  purchase_index             ANY        ANY          ANY    /purchases
  security_login             ANY        ANY          ANY    /login
  security_logout            ANY        ANY          ANY    /logout
  index                      ANY        ANY          ANY    /
  test                       GET|POST   http|https   ANY    /test/{age}{prenom}
  product_category           ANY        ANY          ANY    /{slug}

  // Maintenant /{category_slug}/{slug} se retrouve en dernier.
  product_show               ANY        ANY          ANY    /{category_slug}/{slug}
 -------------------------- ---------- ------------ ------ -----------------------------------

Mise en place de l'algorithme pour le PurchaseConfirmationController.php
reflexiont sur le fonctionnement de /purchase/confirm.
<?php

namespace App\Controller\Purchase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseConfirmationController
{
    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     */
    public function confirm(Request $requet): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request

        // 2. Si le formulaire na pas été soumis : dégager

        // 3. Si je ne suis pas connecté : dégager (Security)

        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)

        // 5. Nous allons créer une Purchase

        // 6. Nous allons le lier avec l'utilisateur actuellement connecté (Security)

        // 7. Nous allons la lier avec les produits qui sont dans le panier (CartService)

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
    }
}

Importation des services pour les différentes actions
<?php

namespace App\Controller\Purchase;

use App\Cart\CartService;
use App\Form\CartConfirmationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class PurchaseConfirmationController
{
    protected $formFactory;
    protected $router;
    protected $security;
    protected $cartService;

    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, Security $security, CartService $cartService)
    {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->security = $security;
        $this->cartService = $cartService;
    }

    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     */
    public function confirm(Request $request, FlashBagInterface $flashBag): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request
        $form = $this->formFactory->create(CartConfirmationType::class);

        $form->handleRequest($request);


        // 2. Si le formulaire na pas été soumis : dégager
        if (!$form->isSubmitted()) {
            // Message Flash puis redirection (FlashBagInterface)
            $flashBag->add('warning', 'Vous devez remplir le formulaire de confirmation');
            return new RedirectResponse($this->router->generate('cart_show'));
        }
        // 3. Si je ne suis pas connecté : dégager (Security)
        $user = $this->security->getUser();

        if (!$user) {
            throw new AccessDeniedException("Vous devez être connecté pour confirmer une commande");
        }


        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)
        $cartItems = $this->cartService->getDetailedCartItems();

        if (count($cartItems) === 0) {
            $flashBag->add('warning', 'Vous ne pouvez confirmer une commande avec un panier vide');
            return new RedirectResponse($this->router->generate('cart_show'));
        }

        // 5. Nous allons créer une Purchase

        // 6. Nous allons le lier avec l'utilisateur actuellement connecté (Security)

        // 7. Nous allons la lier avec les produits qui sont dans le panier (CartService)

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
    }
}

Test des différentes action sur la page index.html.twig de cart

        <h2>Confimez votre commande en remplissant ce formulaire</h2>
        //test de purchase_confirm
		{{ form_start(confirmationForm, {'action': path('purchase_confirm')}) }}

		{{ form_widget(confirmationForm) }}

		<button type="submit" class="btn btn-sucess">Je confirme !</button>

		{{ form_end(confirmationForm) }}

<h3>Le Controller qui va gérer le formulaire (2/2)</h3>
Mise en place du reste de élèment de PurchaseConfirmationController.php

<?php

namespace App\Controller\Purchase;

use DateTime;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class PurchaseConfirmationController
{
    protected $formFactory;
    protected $router;
    protected $security;
    protected $cartService;
    protected $em;

    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, Security $security, CartService $cartService, EntityManagerInterface $em)
    {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->security = $security;
        $this->cartService = $cartService;
        $this->em = $em;
    }

    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     */
    public function confirm(Request $request, FlashBagInterface $flashBag): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request
        $form = $this->formFactory->create(CartConfirmationType::class);

        $form->handleRequest($request);


        // 2. Si le formulaire na pas été soumis : dégager
        if (!$form->isSubmitted()) {
            // Message Flash puis redirection (FlashBagInterface)
            $flashBag->add('warning', 'Vous devez remplir le formulaire de confirmation');
            return new RedirectResponse($this->router->generate('cart_show'));
        }

        // 3. Si je ne suis pas connecté : dégager (Security)
        $user = $this->security->getUser();

        if (!$user) {
            throw new AccessDeniedException("Vous devez être connecté pour confirmer une commande");
        }

        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)
        $cartItems = $this->cartService->getDetailedCartItems();

        if (count($cartItems) === 0) {
            $flashBag->add('warning', 'Vous ne pouvez confirmer une commande avec un panier vide');
            return new RedirectResponse($this->router->generate('cart_show'));
        }


        // 5. Nous allons créer une Purchase qui sera donné par le formulaire CartConfirmationType.php
        /** @var Purchase */
        $purchase = $form->getData();

        // 6. Nous allons le lier avec l'utilisateur actuellement connecté (Security)
        $purchase->setUser($user)
            ->setPurchasedAt(new DateTime());

        $this->em->persist($purchase);

        // 7. Nous allons la lier avec les produits qui sont dans le panier (CartService)
        $total = 0;

        foreach ($this->cartService->getDetailedCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getName())
                ->setQuantity($cartItem->qty)
                ->setTotal($cartItem->getTotal())
                ->setProductPrice($cartItem->product->getPrice());

            $total += $cartItem->getTotal();

            $this->em->persist($purchaseItem);
        }

        $purchase->setTotal($total);

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
        $this->em->flush();

        $flashBag->add('success', "La commande a bien été enregistrée");
        return new RedirectResponse($this->router->generate('purchase_index'));
    }
}

Dans le CartService.php pour avoir un array nous integrons une route @return Cartitem
Comme sa nous avons l'auto complession pour $cartItem

    /**
     *
     * @return CartItem[]
     */
    public function getDetailedCartItems(): array
    {
        $detaileCart = [];


        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            //Si un produit à était suprimé, il continurat la boucle.
            if (!$product) {
                continue;
            }

            $detaileCart[] = new CartItem($product, $qty);
        }

        return $detaileCart;
    }

<h3>Refactoring du Controller</h3>
La bonne pratique et de toujours d'injecter les dépendances avec le constructeur par convention.
Grace a AbstractController nous heritons des services donc nous pouvons en reduire certains code.

<?php

namespace App\Controller\Purchase;

use DateTime;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchaseConfirmationController extends AbstractController
{
    protected $cartService;
    protected $em;

    public function __construct(CartService $cartService, EntityManagerInterface $em)
    {
        $this->cartService = $cartService;
        $this->em = $em;
    }

    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour confirmer une commande")
     */
    public function confirm(Request $request): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request
        $form = $this->createForm(CartConfirmationType::class);

        $form->handleRequest($request);


        // 2. Si le formulaire na pas été soumis : dégager
        if (!$form->isSubmitted()) {
            // Message Flash puis redirection (FlashBagInterface)

            $this->addFlash('warning', 'Vous devez remplir le formulaire de confirmation');
            return $this->redirectToRoute('cart_show');
        }

        // 3. Si je ne suis pas connecté : dégager (Security)
        $user = $this->getUser();


        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)
        $cartItems = $this->cartService->getDetailedCartItems();

        if (count($cartItems) === 0) {
            $this->addFlash('warning', 'Vous ne pouvez confirmer une commande avec un panier vide');
            return $this->redirectToRoute('cart_show');
        }


        // 5. Nous allons créer une Purchase qui sera donné par le formulaire CartConfirmationType.php
        /** @var Purchase */
        $purchase = $form->getData();

        // 6. Nous allons le lier avec l'utilisateur actuellement connecté (Security)
        $purchase->setUser($user)
            ->setPurchasedAt(new DateTime());

        $this->em->persist($purchase);

        // 7. Nous allons la lier avec les produits qui sont dans le panier (CartService)
        $total = 0;

        foreach ($this->cartService->getDetailedCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getName())
                ->setQuantity($cartItem->qty)
                ->setTotal($cartItem->getTotal())
                ->setProductPrice($cartItem->product->getPrice());

            $total += $cartItem->getTotal();

            $this->em->persist($purchaseItem);
        }

        $purchase->setTotal($total);

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
        $this->em->flush();

        $this->addFlash('success', "La commande a bien été enregistrée");
        return $this->redirectToRoute('purchase_index');
    }
}

<h3>Finaliser le processus de commande</h3>

Le soucie est que quand une commande est passer elle reste active.

Dans le CartService.php nous créons un empty avec un tableau vide.

    public function empty()
    {
        $this->saveCart([]);
    }

Dans le PurchaseConfirmationController.php nous allons demandé à vider le pagnier
avant le flush.

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
        $this->em->flush();
        //Vider le cache du panier.
        $this->cartService->empty();

        $this->addFlash('success', "La commande a bien été enregistrée");
        return $this->redirectToRoute('purchase_index');

Le Total exister directement dans le CartService donc dans le PurchaseConfirmationController.php

<?php

namespace App\Controller\Purchase;

use DateTime;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchaseConfirmationController extends AbstractController
{
    protected $cartService;
    protected $em;

    public function __construct(CartService $cartService, EntityManagerInterface $em)
    {
        $this->cartService = $cartService;
        $this->em = $em;
    }

    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour confirmer une commande")
     */
    public function confirm(Request $request): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request
        $form = $this->createForm(CartConfirmationType::class);

        $form->handleRequest($request);


        // 2. Si le formulaire na pas été soumis : dégager
        if (!$form->isSubmitted()) {
            // Message Flash puis redirection (FlashBagInterface)

            $this->addFlash('warning', 'Vous devez remplir le formulaire de confirmation');
            return $this->redirectToRoute('cart_show');
        }

        // 3. Si je ne suis pas connecté : dégager (Security)
        $user = $this->getUser();


        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)
        $cartItems = $this->cartService->getDetailedCartItems();

        if (count($cartItems) === 0) {
            $this->addFlash('warning', 'Vous ne pouvez confirmer une commande avec un panier vide');
            return $this->redirectToRoute('cart_show');
        }


        // 5. Nous allons créer une Purchase qui sera donné par le formulaire CartConfirmationType.php
        /** @var Purchase */
        $purchase = $form->getData();

        // 6. Nous allons le lier avec l'utilisateur actuellement connecté (Security)
        $purchase->setUser($user)
            ->setPurchasedAt(new DateTime())
            //Nous appelons directement le setTotal du CartService
            ->setTotal($this->cartService->getTotal());

        $this->em->persist($purchase);

        // 7. Nous allons la lier avec les produits qui sont dans le panier (CartService)
        foreach ($this->cartService->getDetailedCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getName())
                ->setQuantity($cartItem->qty)
                ->setTotal($cartItem->getTotal())
                ->setProductPrice($cartItem->product->getPrice());

            $this->em->persist($purchaseItem);
        }

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
        $this->em->flush();

        $this->cartService->empty();

        $this->addFlash('success', "La commande a bien été enregistrée");
        return $this->redirectToRoute('purchase_index');
    }
}

pour la sécuritée de pour la connection de la confirmationForm.
Dans le dossier template->car-> du fichier index.html.twig

        {% if app.user %}
			<h2>Confimez votre commande en remplissant ce formulaire</h2>
			{{ form_start(confirmationForm, {'action': path('purchase_confirm')}) }}

			{{ form_widget(confirmationForm) }}
			<hr>
			<button type="submit" class="btn btn-sucess">Je confirme !</button>

			{{ form_end(confirmationForm) }}
		{% else %}
			<h2>Vous devez être connecté pour confirmer cette commande</h2>
			<a href=" {{ path('security_login')}} " class="btn btn-sucess">Connection</a>
			ou
			<a href="#">Créez un compte</a>
		{% endif %}

<h3>📖 Conclusion</h3>

Single Responsibility Principal
Faites de votre mieux pour distribuer les Responsabilités sur différentes classes!
La liste de commande d'un coté PurchasesListController
Et la prise de commande de l'autre PurchaseConfirmationController

Surtout appliquer les bonnes pratiques et appliquer les outils qui sont fournie.

<h3>Refactoring : créer une classe pour persister la Purchase</h3>
La bonne pratique: dispachez les responsabilités dans des classes séparées
(Single Responsability Principle)

Le PurchaseConfirmationController.php les code sont trop regrouper. Il faut eviter de melanger les fonctions 
pour persister et les confirmations de commande.

<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use App\Purchase\PurchasePersister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchaseConfirmationController extends AbstractController
{
    protected $cartService;
    protected $em;
    protected $persister;

    public function __construct(CartService $cartService, EntityManagerInterface $em, PurchasePersister $persister)
    {
        $this->cartService = $cartService;
        $this->em = $em;
        $this->persister = $persister;
    }


    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour confirmer une commande")
     */
    public function confirm(Request $request): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request
        $form = $this->createForm(CartConfirmationType::class);

        $form->handleRequest($request);


        // 2. Si le formulaire na pas été soumis : dégager
        if (!$form->isSubmitted()) {
            // Message Flash puis redirection (FlashBagInterface)

            $this->addFlash('warning', 'Vous devez remplir le formulaire de confirmation');
            return $this->redirectToRoute('cart_show');
        }


        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)
        $cartItems = $this->cartService->getDetailedCartItems();

        if (count($cartItems) === 0) {
            $this->addFlash('warning', 'Vous ne pouvez confirmer une commande avec un panier vide');
            return $this->redirectToRoute('cart_show');
        }


        // 5. Nous allons créer une Purchase qui sera donné par le formulaire CartConfirmationType.php
        /** @var Purchase */
        $purchase = $form->getData();

        $this->persister->storePurchase($purchase);

        $this->cartService->empty();

        $this->addFlash('success', "La commande a bien été enregistrée");

        return $this->redirectToRoute('purchase_index');
    }
}

Pour la partie Persiter Nous créons un dossier Purchase dans src et nous créons une classe PurchasePersister.php

<?php

namespace App\Purchase;

use App\Cart\CartService;
use DateTime;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class PurchasePersister
{
    protected $security;
    protected $cartService;
    protected $em;


    public function __construct(Security $security, CartService $cartService, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->cartService = $cartService;
        $this->em = $em;
    }

    public function storePurchase(Purchase $purchase)
    {
        // Intégrer tout ce qu'il faut et persister la purchase
        // 6. Nous allons le lier avec l'utilisateur actuellement connecté (Security)
        $purchase->setUser($this->security->getUser())
            ->setPurchasedAt(new DateTime())
            ->setTotal($this->cartService->getTotal());

        $this->em->persist($purchase);

        // 7. Nous allons la lier avec les produits qui sont dans le panier (CartService)
        foreach ($this->cartService->getDetailedCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getName())
                ->setQuantity($cartItem->qty)
                ->setTotal($cartItem->getTotal())
                ->setProductPrice($cartItem->product->getPrice());

            $this->em->persist($purchaseItem);
        }

        // 8. Nous allons enregistrer la commande (EntityManagerInterface)
        $this->em->flush();
    }
}

<h2>Architecture et paiement Stripe ! (55 minutes)</h2>

Utilisation de l'API Stripe pour le paiement (https://stripe.com/fr/docs/api)

Création d'un compte Stripe (https://dashboard.stripe.com/register) une fois le compte créé,
aller sur la documentation https://stripe.com/docs/payments?payments=popular puis accepter les paiments en ligne,
https://stripe.com/docs/checkout/quickstart

<h3>Mise en place de la page de paiement</h3>

Creation du fichier Purchase PurchasePaymentController.php dans le quel nous allons créer la page de paiement.

<?php

namespace App\Controller\Purchase;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasePaymentController extends AbstractController
{
    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     */
    public function ShowCardForm()
    {
        return $this->render('purchase/payment.html.twig');
    }
}

Creation dans le dossier templates de purchase le fichier payment.html.twig

{% extends "base.html.twig" %}

{% block titel %}
	Payer votre commande avec stripe
{% endblock %}

{% block body %}
	<h1>Payer votre commande avec Stripe</h1>
{% endblock %}

Nous modifion le PurchaseConfirmationController.php pour ajouter le code suivant :


<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use App\Purchase\PurchasePersister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchaseConfirmationController extends AbstractController
{
    protected $cartService;
    protected $em;
    protected $persister;

    public function __construct(CartService $cartService, EntityManagerInterface $em, PurchasePersister $persister)
    {
        $this->cartService = $cartService;
        $this->em = $em;
        $this->persister = $persister;
    }


    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour confirmer une commande")
     */
    public function confirm(Request $request): Response
    {
        // 1. Nous voulons lire les données du formulaire
        // FormFactoryInterface / Request
        $form = $this->createForm(CartConfirmationType::class);

        $form->handleRequest($request);


        // 2. Si le formulaire na pas été soumis : dégager
        if (!$form->isSubmitted()) {
            // Message Flash puis redirection (FlashBagInterface)

            $this->addFlash('warning', 'Vous devez remplir le formulaire de confirmation');
            return $this->redirectToRoute('cart_show');
        }


        // 4. Si il n'y a pas de produits dans mon panier : dégarger (CartService)
        $cartItems = $this->cartService->getDetailedCartItems();

        if (count($cartItems) === 0) {
            $this->addFlash('warning', 'Vous ne pouvez confirmer une commande avec un panier vide');
            return $this->redirectToRoute('cart_show');
        }


        // 5. Nous allons créer une Purchase qui sera donné par le formulaire CartConfirmationType.php
        /** @var Purchase */
        $purchase = $form->getData();

        $this->persister->storePurchase($purchase);

        //Supression de la ligne qui vide la panier et la ligne message addFlash
        //- $this->cartService->empty();
        Le panier ne doit pas étre vide si la personne decide de changer d'avis.
        //- $this->addFlash('success', "La commande a bien été enregistrée");

        // Nouvelle redirection pour le paiment avec le id de la commande
        return $this->redirectToRoute('purchase_payment_form', [
            'id' => $purchase->getId()
        ]);
    }
}
<h3>Créer une intention de paiement avec Stripe</h3>

Mise en place de stripe dans notre application.
Installation de stripe : composer require stripe/stripe-php

Mise en place de stripe sur PurchasePaymentController.php

<?php

namespace App\Controller\Purchase;

use App\Repository\PurchaseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasePaymentController extends AbstractController
{
    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     */
    public function ShowCardForm($id, PurchaseRepository $purchaseRepository)
    {
        $purchase = $purchaseRepository->find($id);
        // Si la commande n'existe pas : redirection
        if (!$purchase) {
            return $this->redirectToRoute('cart_show');
        }

        // Ceci est un exemple de clé API de test.
        \Stripe\Stripe::setApiKey('sk_test_51Iil1QJGVAs2Om8rquD7QN41xXVIhaBnLoBD53mCJzl86hQsSreAOjN3E9geTj8C9dMojtDTAFVfhokKXgkrBLFU00i9UiavPu');

        // Créer un PaymentIntent avec le montant et la devise
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $purchase->getTotal(),
            'currency' => 'eur',
        ]);


        return $this->render('purchase/payment.html.twig', [
            'clientSecret' => $intent->client_secret,
        ]);
    }
}

<h3>Formulaire de carte bleue avec Stripe Elements</h3>

Creation dans le dossier templates de purchase le fichier payment.html.twig
Suivant la documentation https://stripe.com/docs et https://stripe.com/docs/payments/quickstart.
Créer une page de paiement sur le client

{% extends "base.html.twig" %}

{% block titel %}
	Payer votre commande avec stripe
{% endblock %}

{% block body %}

	<h1>Payer votre commande avec Stripe</h1>
    // Mise en place d'une page de paiement sur le client
    //Définir le formulaire de paiement
	<form id="payment-form">
		<h3>Entrée votre numéro de carte</h3>
		<div
			class='container' id="card-element">
			<!--Stripe.js injects the Payment Element-->
			<h3>cart</h3>
		</div>
		<hr>
		<button id="submit" class="btn btn-success">
			<div class="spinner hidden" id="spinner"></div>
			<span id="button-text">Payer avec stripe !</span>
		</button>
		<p id="card-error" role="alert"></p>
		<div id="card-message" class="hidden"></div>
	</form>
    //Charger Stripe.js
    //Utilisez Stripe.js pour rester conforme à la norme PCI en vous assurant que les détails de 
    //paiement sont envoyés directement à Stripe sans toucher votre serveur.
	<script src="https://js.stripe.com/v3/"></script>
    //
	<script src="/js/payment.js"></script>

{% endblock %}

{% block javascripts %}
	{{ parent() }}
	<script>
		const clientSecret = '{{ clientSecret }}';
        //Initialisez Stripe.js avec vos clés API
const stripePublicKey = '{{ stripePublicKey }}';
const redirectAfterSuccessUrl = "{{ url('purchase_payment_success', { 'id': purchase.id }) }}"
	</script>
{% endblock %}

Créer un dossier JS dans le dossier public puis créer le fichier payment.js
Dans le quel nous allons metre en place le code de de card.
Créer un Élément de paiementet montez-le sur l'espace réservé <div>dans votre formulaire de paiement. Cela intègre un iframe avec un formulaire dynamique qui affiche les types de modes de paiement configurés disponibles à partir de PaymentIntent, permettant à votre client de sélectionner un mode de paiement. Le formulaire collecte automatiquement les détails des paiements associés pour le type de mode de paiement sélectionné.

const stripe = Stripe(stripePublicKey);

const elements = stripe.elements();

const card = elements.create("card");
// Stripe injects an iframe into the DOM
card.mount("#card-element");

card.on("change", function (event) {
    // Disable the Pay button if there are no card details in the Element
    document.querySelector("button").disabled = event.empty;
    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
});


const form = document.getElementById("payment-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    // Complete payment when the submit button is clicked
    //payWithCard(stripe, card, data.clientSecret);
    stripe
        .confirmCardPayment(clientSecret, {
            payment_method: {
                card: card
            }
        })
        .then(function (result) {
            if (result.error) {
                // Show error to your customer
                console.log(result.error.message);
            } else {
                // The payment succeeded!
                window.location.href = redirectAfterSuccessUrl;
            }
        });

});

Gestion des clefs API:
Dans le dossier config, mise en place des clef API de stripe.

App\Stripe\StripeService:
        arguments:
            $secretKey: '%env(STRIPE_SECRET_KEY)%'
            $publicKey: '%env(STRIPE_PUBLIC_KEY)%'

Pour evité de faire les changements en le mode development et le mode production. Pour la gestion des clef API.
Il faut les mettre en place dans le fichier .env.

STRIPE_PUBLIC_KEY="pk_test_51Iil1QJGVAs2Om8revWfx73zmkXeGt6VLJkicoPiTwXQ18gr5GTLoFFIQ7IVVM8Brxvvb8VOypvpLM9wBC3rwoEl00lsfFYuOa"
STRIPE_SECRET_KEY="sk_test_51Iil1QJGVAs2Om8rquD7QN41xXVIhaBnLoBD53mCJzl86hQsSreAOjN3E9geTj8C9dMojtDTAFVfhokKXgkrBLFU00i9UiavPu"

<h3>Finaliser le paiement après confirmation de Stripe</h3>

Création dans le dossier src->Controller->PurchasePaymentSuccesController.php
Permet de vérifier et de validé le paiement pour enfin étre rediriger.

<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasePaymentSuccessController extends AbstractController
{
    /**
     * @Route("/purchase/terminate/{id}", name="purchase_payment_success")
     * @IsGranted("ROLE_USER")
     */
    public function index($id, PurchaseRepository $purchaseRepository, EntityManagerInterface $em, CartService $cartService)
    {


        //1. Je récupère la commande
        $purchase = $purchaseRepository->find($id);


        if (
            !$purchase ||
            ($purchase && $purchase->getUser() !== $this->getUser()) ||
            ($purchase && $purchase->getStatus() === Purchase::STATUS_PAID)
        ) {
            $this->addFlash('warning', "La commande n'existe pas");
            return $this->redirectToRoute("purchase_index");
        }
        //2. Je la fait passer au status PAYEE (PAID)
        $purchase->setStatus(Purchase::STATUS_PAID);
        $em->flush();

        //3. Je vide le panier
        $cartService->empty();

        //4. Je redirige avec un flash vers la liste des commandes
        $this->addFlash('success', "La commande a été payée et confirmée !");
        return $this->redirectToRoute("purchase_index");
    }
}

<h3>Refactoring créer un StripeService</h3>

Creation d'un dossier Stripe dans le dossier src puis créer le fichier StripeService.php

<?php

namespace App\Stripe;

use App\Entity\Purchase;

class StripeService
{
    protected $secretKey;
    protected $publicKey;

    public function __construct(string $secretKey, string $publicKey)
    {

        $this->secretKey = $secretKey;
        $this->publicKey = $publicKey;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPaymentIntent(Purchase $purchase)
    {
        // This is a sample test API key.
        \Stripe\Stripe::setApiKey($this->secretKey);

        return \Stripe\PaymentIntent::create([
            'amount' => $purchase->getTotal(),
            'currency' => 'eur'
        ]);
    }
}

Gestion des clefs API:
Dans le dossier config, mise en place des clef API de stripe.

App\Stripe\StripeService:
        arguments:
            $secretKey: '%env(STRIPE_SECRET_KEY)%'
            $publicKey: '%env(STRIPE_PUBLIC_KEY)%'

Pour evité de faire les changements en le mode development et le mode production. Pour la gestion des clef API.
Il faut les mettre en place dans le fichier .env.

STRIPE_PUBLIC_KEY="pk_test_51Iil1QJGVAs2Om8revWfx73zmkXeGt6VLJkicoPiTwXQ18gr5GTLoFFIQ7IVVM8Brxvvb8VOypvpLM9wBC3rwoEl00lsfFYuOa"
STRIPE_SECRET_KEY="sk_test_51Iil1QJGVAs2Om8rquD7QN41xXVIhaBnLoBD53mCJzl86hQsSreAOjN3E9geTj8C9dMojtDTAFVfhokKXgkrBLFU00i9UiavPu"

Integration du StripeService dans le fichier PurchasePaymentController.php

<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Stripe\StripeService;
use App\Repository\PurchaseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasePaymentController extends AbstractController
{
    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     * @IsGranted("ROLE_USER")
     */
    public function ShowCardForm($id, PurchaseRepository $purchaseRepository, StripeService $stripeService)
    {
        $purchase = $purchaseRepository->find($id);

        if (
            !$purchase ||
            ($purchase && $purchase->getUser() !== $this->getUser()) ||
            ($purchase && $purchase->getStatus() === Purchase::STATUS_PAID)
        ) {
            return $this->redirectToRoute('cart_show');
        }

        $intent = $stripeService->getPaymentIntent($purchase);


        return $this->render('purchase/payment.html.twig', [
            'clientSecret' => $intent->client_secret,
            'purchase' => $purchase,
            'stripePublicKey' => $stripeService->getPublicKey()
        ]);
    }
}

<h3>Définition du StripeService dans le fichier services.yaml</h3>

Dans le dossier config, mise en place des clef API de stripe.

App\Stripe\StripeService:
        arguments:
            $secretKey: '%env(STRIPE_SECRET_KEY)%'
            $publicKey: '%env(STRIPE_PUBLIC_KEY)%'

<h3>Refactoring du Javascript</h3>

Créer un dossier JS dans le dossier public puis créer le fichier payment.js
Dans le quel nous allons metre en place le code de de card.
Créer un Élément de paiementet montez-le sur l'espace réservé <div>dans votre formulaire de paiement. Cela intègre un iframe avec un formulaire dynamique qui affiche les types de modes de paiement configurés disponibles à partir de PaymentIntent, permettant à votre client de sélectionner un mode de paiement. Le formulaire collecte automatiquement les détails des paiements associés pour le type de mode de paiement sélectionné.

const stripe = Stripe(stripePublicKey);

const elements = stripe.elements();

const card = elements.create("card");
// Stripe injects an iframe into the DOM
card.mount("#card-element");

card.on("change", function (event) {
    // Disable the Pay button if there are no card details in the Element
    document.querySelector("button").disabled = event.empty;
    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
});


const form = document.getElementById("payment-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    // Complete payment when the submit button is clicked
    //payWithCard(stripe, card, data.clientSecret);
    stripe
        .confirmCardPayment(clientSecret, {
            payment_method: {
                card: card
            }
        })
        .then(function (result) {
            if (result.error) {
                // Show error to your customer
                console.log(result.error.message);
            } else {
                // The payment succeeded!
                window.location.href = redirectAfterSuccessUrl;
            }
        });

});

Dans le fichier payment.html.twig importation des élèment
{% extends "base.html.twig" %}

{% block titel %}
	Payer votre commande avec stripe
{% endblock %}

{% block body %}

	<h1>Payer votre commande avec Stripe</h1>
    // Mise en place d'une page de paiement sur le client
    //Définir le formulaire de paiement
	<form id="payment-form">
		<h3>Entrée votre numéro de carte</h3>
		<div
			class='container' id="card-element">
			<!--Stripe.js injects the Payment Element-->
			<h3>cart</h3>
		</div>
		<hr>
		<button id="submit" class="btn btn-success">
			<div class="spinner hidden" id="spinner"></div>
			<span id="button-text">Payer avec stripe !</span>
		</button>
		<p id="card-error" role="alert"></p>
		<div id="card-message" class="hidden"></div>
	</form>
    //Charger Stripe.js
    //Utilisez Stripe.js pour rester conforme à la norme PCI en vous assurant que les détails de 
    //paiement sont envoyés directement à Stripe sans toucher votre serveur.
	<script src="https://js.stripe.com/v3/"></script>
    //
	<script src="/js/payment.js"></script>

{% endblock %}

{% block javascripts %}
	{{ parent() }}
	<script>
        //Initialisez Stripe.js avec vos clés API
		const clientSecret = '{{ clientSecret }}';  
        const stripePublicKey = '{{ stripePublicKey }}';
        //redirection après le paiement réussi
        const redirectAfterSuccessUrl = "{{ url('purchase_payment_success', { 'id': purchase.id }) }}"
	</script>
{% endblock %}

<h3>Stocker les clés Stripes dans des variables d'environnement (.env)</h3>

Pour evité de faire les changements en le mode development et le mode production. Pour la gestion des clef API.
Il faut les mettre en place dans le fichier .env.

STRIPE_PUBLIC_KEY="pk_test_51Iil1QJGVAs2Om8revWfx73zmkXeGt6VLJkicoPiTwXQ18gr5GTLoFFIQ7IVVM8Brxvvb8VOypvpLM9wBC3rwoEl00lsfFYuOa"
STRIPE_SECRET_KEY="sk_test_51Iil1QJGVAs2Om8rquD7QN41xXVIhaBnLoBD53mCJzl86hQsSreAOjN3E9geTj8C9dMojtDTAFVfhokKXgkrBLFU00i9UiavPu"

Gestion des clefs API:
Dans le dossier config, mise en place des clef API de stripe.

App\Stripe\StripeService:
        arguments:
            $secretKey: '%env(STRIPE_SECRET_KEY)%'
            $publicKey: '%env(STRIPE_PUBLIC_KEY)%'

<h3>Etudiez les Webhooks de Stripe !</h3>

Pour l'instant notre système n'est pas très sécurisé : si le client connait l'adresse à appeler pour faire passer une commande au statut PAID, il peut le faire alors même qu'il n'a pas payé la commande.

C'est la principale raison d'étudier les WebHooks pour sécuriser ce point là et ne plus avoir un moyen aussi simple de faire passer la commande en statut PAID !

Stripe peut appeler votre site quand un paiement est fait, de telle sorte que ce ne soit pas le client dans son navigateur qui fasse passer la commande au statut PAID mais uniquement Stripe qui est au courant d'une adresse qu'il peut contacter pour compléter un paiement !

📖 Documentation sur les WebHooks : https://stripe.com/docs/payments/checkout/fulfill-orders


<h2>Symfony et les événements (1 heure et 15 minutes)</h2>

<h3>Introduction aux événements dans Symfony</h3>
https://sites.google.com/site/symfonikhal/p4-allez-plus-loin/5-le-gestionnaire-d-evenements

<h3>Prérequis : passages par valeur / référence</h3>
https://www.php.net/manual/fr/language.references.pass.php
http://www.lephpfacile.com/manuel-php/language.references.pass.php


<h3>Le design pattern Mediator</h3>
https://symfony.com/doc/current/components/event_dispatcher.html
https://www.babeuloula.fr/blog/le-design-pattern-strategy-dans-symfony.html

<h3>Voir les événements et les réactions dans le profiler</h3>
https://symfony.com/doc/current/event_dispatcher.html

<h3>Plongée dans le coeur de Symfony : le Kernel et les événements</h3>
https://symfony.com/doc/current/reference/events.html

<h3>Création de notre premier Listener</h3>

Dans ProductController.php nous appellons la request.

    /**
     * @Route("/{category_slug}/{slug}", name="product_show", priority=-2)
     */
    public function show($slug, ProductRepository $productRepository, Request $request): Response
    {
        dd($request->attributes);
        
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

On obtient les attributs de la requête dans la méthode show.
On retrouve les informations de l'attribut de la requette.

ProductController.php on line 50:
Symfony\Component\HttpFoundation\ParameterBag {#96 ▼
  #parameters: array:7 [▼
    "_route" => "product_show"
    "_controller" => "App\Controller\ProductController::show"
    "category_slug" => "baby"
    "slug" => "lightweight-wool-gloves"
    "_route_params" => array:2 [▼
      "category_slug" => "baby"
      "slug" => "lightweight-wool-gloves"
    ]
    "_firewall_context" => "security.firewall.map.context.main"
    "_access_control_attributes" => null
  ]
}

Mais ont peu passé n'importe quel attribut de la requête.

    /**
     * @Route("/{category_slug}/{slug}", name="product_show", priority=-2)
     */
    public function show($slug, $category_slug, ProductRepository $productRepository, Request $request): Response
    {
        dump($category_slug);

        dd($request->attributes);

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

Symfony à était capable de donner $category_slug et $slug.

dump($category_slug);
dd($request->attributes);

Grace à l'argumente résolver ont n'est capable de donner tout les informations qui sont utilisées.

ProductController.php on line 50:
"baby"
ProductController.php on line 52:
Symfony\Component\HttpFoundation\ParameterBag {#96 ▼
  #parameters: array:7 [▼
    "_route" => "product_show"
    "_controller" => "App\Controller\ProductController::show"
    "category_slug" => "baby"
    "slug" => "lightweight-wool-gloves"
    "_route_params" => array:2 [▼
      "category_slug" => "baby"
      "slug" => "lightweight-wool-gloves"
    ]
    "_firewall_context" => "security.firewall.map.context.main"
    "_access_control_attributes" => null
  ]
}

Maintenant si on lui demande la variable $prenom il ne vas pas trouver la variable.

    /**
     * @Route("/{category_slug}/{slug}", name="product_show", priority=-2)
     */
    public function show($slug, $prenom, ProductRepository $productRepository, Request $request): Response
    {
        dd($request->attributes);

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

L'agument resolver n'est pas capable de donner tout les informations qui sont utilisées. $prenom n'est pas trouvé.
Il affiche le message d'erreur.
Controller "App\Controller\ProductController::show()" requires that you provide a value for the "$prenom" argument. Either the argument is nullable and no null value has been provided, no default value has been provided or because there is a non optional argument after this one.

L'argument resolver est capable de passé à tout mes controller des donner qui son dans les attributs de la requete.
Pour donner un exemple concrait il serait bien d'avoir un prenom dans les attributs de la requete.
Creation du dossier EventListener puis un fichier PrenomListener.php.

<?php

namespace App\EventsDispatcher;

class PrenomListener
{
    public function addPrenomToAtributes()
    {
        dd('ca fonctionne');
    }
}

Tachon de voir si il apparait quand on fait appel de 

php bin/console debug:event-dispatcher kernel.request

Registered Listeners for "kernel.request" Event
===============================================

 ------- ---------------------------------------------------------------------------------------------- ----------
  Order   Callable                                                                                       Priority 
 ------- ---------------------------------------------------------------------------------------------- ----------
  #1      Symfony\Component\HttpKernel\EventListener\DebugHandlersListener::configure()                  2048
  #2      Symfony\Component\HttpKernel\EventListener\ValidateRequestListener::onKernelRequest()          256
  #3      Symfony\Component\HttpKernel\EventListener\SessionListener::onKernelRequest()                  128
  #4      Symfony\Component\HttpKernel\EventListener\LocaleListener::setDefaultLocale()                  100
  #5      Symfony\Component\HttpKernel\EventListener\RouterListener::onKernelRequest()                   32
  #6      Symfony\Component\HttpKernel\EventListener\LocaleListener::onKernelRequest()                   16
  #7      Symfony\Component\HttpKernel\EventListener\LocaleAwareListener::onKernelRequest()              15
  #8      Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener::configureLogoutUrlGenerator()   8
  #9      Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener::onKernelRequest()               8
 ------- ---------------------------------------------------------------------------------------------- ----------

Ont se rend compte que la class PrenomListener n'apparait pas. La raisont est que nous n'avons jamais 
prévenue que nous avions brancher le listener PrenomListener.
Pour le prévenir c'est assez symple il suffit de le déclarer dans le fichier services.yaml.

    App\EventDispatcher\PrenomListener:
        tags: 
            [
                {
                    name: kernel.event_listener, 
                    event: kernel.request, 
                    method: addPrenomToAtributes,
                },
            ]

php bin/console debug:event-dispatcher kernel.request

------- ---------------------------------------------------------------------------------------------- ---------- 
  Order   Callable                                                                                       Priority  
 ------- ---------------------------------------------------------------------------------------------- ----------
  #1      Symfony\Component\HttpKernel\EventListener\DebugHandlersListener::configure()                  2048
  #2      Symfony\Component\HttpKernel\EventListener\ValidateRequestListener::onKernelRequest()          256       
  #3      Symfony\Component\HttpKernel\EventListener\SessionListener::onKernelRequest()                  128       
  #4      Symfony\Component\HttpKernel\EventListener\LocaleListener::setDefaultLocale()                  100
  #5      Symfony\Component\HttpKernel\EventListener\RouterListener::onKernelRequest()                   32
  #6      Symfony\Component\HttpKernel\EventListener\LocaleListener::onKernelRequest()                   16
  #7      Symfony\Component\HttpKernel\EventListener\LocaleAwareListener::onKernelRequest()              15
  #8      Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener::configureLogoutUrlGenerator()   8
  #9      Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener::onKernelRequest()               8
  #10     App\EventDispatcher\PrenomListener::addPrenomToAtributes()                                     0
 ------- ---------------------------------------------------------------------------------------------- ----------
Maintenant App\EventDispatcher\PrenomListener::addPrenomToAtributes() apparait bien.

Maintenant le dd('ca fonctionne') apparait sur la page.

PrenomListener.php on line 9:
"ca fonctionne"

Donc on peux recevoir la RequestEvent.    

<?php

namespace App\EventDispatcher;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class PrenomListener
{
    public function addPrenomToAtributes(RequestEvent $requestEvent)
    {
        dd($requestEvent);
    }
}

Qu'affiche le dd ,la request.

PrenomListener.php on line 11:
Symfony\Component\HttpKernel\Event\RequestEvent {#4760 ▼
  -response: null
  -kernel: Symfony\Component\HttpKernel\HttpKernel {#1013 ▶}
  -request: Symfony\Component\HttpFoundation\Request {#51 ▼
    +attributes: Symfony\Component\HttpFoundation\ParameterBag {#96 ▶}
    +request: Symfony\Component\HttpFoundation\ParameterBag {#103 ▶}
    +query: Symfony\Component\HttpFoundation\InputBag {#97 ▶}
    +server: Symfony\Component\HttpFoundation\ServerBag {#93 ▶}
    +files: Symfony\Component\HttpFoundation\FileBag {#94 ▶}
    +cookies: Symfony\Component\HttpFoundation\InputBag {#95 ▶}
    +headers: Symfony\Component\HttpFoundation\HeaderBag {#92 ▶}
    #content: null
    #languages: null
    #charsets: null
    #encodings: null
    #acceptableContentTypes: null
    #pathInfo: "/baby/lightweight-wool-gloves"
    #requestUri: "/baby/lightweight-wool-gloves"
    #baseUrl: ""
    #basePath: null
    #method: "GET"
    #format: null
    #session: Closure() {#5866 ▶}
    #locale: null
    #defaultLocale: "en"
    -preferredFormat: null
    -isHostValid: true
    -isForwardedValid: true
    -isSafeContentPreferred: null
    basePath: ""
    format: "html"
  }
  -requestType: 1
  -propagationStopped: false
}

Maintenant nous allons attribuer un prenon dans PrenomListener.

<?php

namespace App\EventDispatcher;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class PrenomListener
{
    public function addPrenomToAtributes(RequestEvent $requestEvent)
    {
        $requestEvent->getRequest()->attributes->set('prenom', 'Rodolphe');
        dd($requestEvent->getRequest());
}

Quand on fais le dd($requestEvent->getRequest()) on a le prenom.

PrenomListener.php on line 12:
Symfony\Component\HttpFoundation\Request {#51 ▼
  +attributes: Symfony\Component\HttpFoundation\ParameterBag {#96 ▼
    #parameters: array:8 [▼
      "_route" => "product_show"
      "_controller" => "App\Controller\ProductController::show"
      "category_slug" => "baby"
      "slug" => "lightweight-wool-gloves"
      "_route_params" => array:2 [▶]
      "_firewall_context" => "security.firewall.map.context.main"
      "_access_control_attributes" => null
      "prenom" => "Rodolphe"
    ]
  }
  +request: Symfony\Component\HttpFoundation\ParameterBag {#103 ▶}
  +query: Symfony\Component\HttpFoundation\InputBag {#97 ▶}
  +server: Symfony\Component\HttpFoundation\ServerBag {#93 ▶}
  +files: Symfony\Component\HttpFoundation\FileBag {#94 ▶}
  +cookies: Symfony\Component\HttpFoundation\InputBag {#95 ▶}
  +headers: Symfony\Component\HttpFoundation\HeaderBag {#92 ▶}
  #content: null
  #languages: null
  #charsets: null
  #encodings: null
  #acceptableContentTypes: null
  #pathInfo: "/baby/lightweight-wool-gloves"
  #requestUri: "/baby/lightweight-wool-gloves"
  #baseUrl: ""
  #basePath: null
  #method: "GET"
  #format: null
  #session: Closure() {#157 ▶}
  #locale: null
  #defaultLocale: "en"
  -preferredFormat: null
  -isHostValid: true
  -isForwardedValid: true
  -isSafeContentPreferred: null
  basePath: ""
  format: "html"
}


Les paramétres sont passées l'agumente resolver sera capable de les afficher 
que si il font partie des attributs.

/**
     * @Route("/{category_slug}/{slug}", name="product_show", priority=-2)
     */
    public function show($slug, $prenom, ProductRepository $productRepository, Request $request): Response
    {
        dd($request->attributes);

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

Maintenant on suprimme de dd($request->attributes) le prenom.
<?php

namespace App\EventDispatcher;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class PrenomListener
{
    public function addPrenomToAtributes(RequestEvent $requestEvent)
    {
        $requestEvent->getRequest()->attributes->set('prenom', 'Rodolphe');
    }
}

Et dans le ProductController on ajoute le dd('prenom').

    /**
     * @Route("/{category_slug}/{slug}", name="product_show", priority=-2)
     */
    public function show($slug, $prenom, ProductRepository $productRepository, Request $request): Response
    {
        dd($prenom);

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

Le dd('prenom') est maintenant affiché.

ProductController.php on line 50:
"Rodolphe"

Maintenant si je le souhaite je peux retrouver dans tout mes controller le $prenom.
Si j'ai besoin d'une info dans d'un projet je peu le rajouter dans mon controller.

<h3>Découverte et création de notre premier Subscriber</h3>

Maintenant nous allons tester des events.   
Reprenons PrenomListener.php

<?php

namespace App\EventDispatcher;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class PrenomListener
{
    public function addPrenomToAtributes(RequestEvent $requestEvent)
    {
        $requestEvent->getRequest()->attributes->set('prenom', 'Rodolphe');
    }
    // Nouveau test.
    public function test1()
    {
        dump('test1');
    }

    public function test2()
    {
        dump('test2');
    }
}

Dans le service container on ajoute le test1 et le test2.

App\EventDispatcher\PrenomListener:
        tags: 
            [
                {
                    name: kernel.event_listener, 
                    event: kernel.request, 
                    method: addPrenomToAtributes,
                },
                {
                    name: kernel.event_listener,
                    event: kernel.controller,
                    method: test1
                },
                {
                    name: kernel.event_listener,
                    event: kernel.response,
                    method: test2
                },
            ]

Maintenat sur la page du site web dans la barre de controle de php nous voyons une sible.
Qui représente les dumps test1 et test2.

Si nous appellon: php bin/console debug:event-dispatcher kernel.controller

Registered Listeners for "kernel.controller" Event
==================================================

 ------- ----------------------------------------------------------------------------------------------- ---------- 
  Order   Callable                                                                                        Priority  
 ------- ----------------------------------------------------------------------------------------------- ----------
  #1      App\EventDispatcher\PrenomListener::test1()                                                     0
  #2      Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector::onKernelController()          0
  #3      Symfony\Component\HttpKernel\DataCollector\RequestDataCollector::onKernelController()           0
  #4      Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener::onKernelController()       0
  #5      Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener::onKernelController()   0
  #6      Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener::onKernelController()        0
  #7      Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener::onKernelController()         -128
 ------- ----------------------------------------------------------------------------------------------- ----------


php bin/console debug:event-dispatcher kernel.response 

Registered Listeners for "kernel.response" Event
================================================

 ------- -------------------------------------------------------------------------------------------- ---------- 
  Order   Callable                                                                                     Priority  
 ------- -------------------------------------------------------------------------------------------- ----------
  #1      App\EventDispatcher\PrenomListener::test2()                                                  0
  #2      Symfony\Component\HttpKernel\EventListener\ResponseListener::onKernelResponse()              0
  #3      Symfony\Component\HttpKernel\DataCollector\RequestDataCollector::onKernelResponse()          0
  #4      Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener::onKernelResponse()       0
  #5      Symfony\Component\Security\Http\RememberMe\ResponseListener::onKernelResponse()              0
  #6      Symfony\Component\HttpKernel\EventListener\ProfilerListener::onKernelResponse()              -100
  #7      Symfony\Component\HttpKernel\EventListener\ErrorListener::removeCspHeader()                  -128
  #8      Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener::onKernelResponse()   -128
  #9      Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener::onResponse()      -255
  #10     Symfony\Component\HttpKernel\EventListener\SessionListener::onKernelResponse()               -1000
  #11     Symfony\Component\HttpKernel\EventListener\StreamedResponseListener::onKernelResponse()      -1024
 ------- -------------------------------------------------------------------------------------------- ----------

Donc nous avons des functions test1 et test2 qui sont appelées lorsque nous appelons.

Mais pour appeler chaque function nous sommes pas obliger de les appelées dans le service.yaml.
Il ne faut plus passer par des listeners mais par de subscribers.
Dans PrenomListener.php avec EventSubscriberInterface.

<?php

namespace App\EventDispatcher;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

//Grace a cette funtion plus besoin du service.yaml

class PrenomSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'addPrenomToAttributes',
            'kernel.controller' => 'test1',
            'kernel.response' => 'test2',
        ];
    }

    public function addPrenomToAtributes(RequestEvent $requestEvent)
    {
        $requestEvent->getRequest()->attributes->set('prenom', 'Rodolphe');
    }

    public function test1()
    {
        dump('test1');
    }

    public function test2()
    {
        dump('test2');
    }
}

Dans le terminal
php bin/console debug:event-dispatcher kernel.response

Registered Listeners for "kernel.response" Event
================================================

 ------- -------------------------------------------------------------------------------------------- ---------- 
  Order   Callable                                                                                     Priority  
 ------- -------------------------------------------------------------------------------------------- ----------
  #1      App\EventDispatcher\PrenomSubscriber::test2()                                                0
  #2      Symfony\Component\HttpKernel\EventListener\ResponseListener::onKernelResponse()              0
  #3      Symfony\Component\HttpKernel\DataCollector\RequestDataCollector::onKernelResponse()          0
  #4      Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener::onKernelResponse()       0
  #5      Symfony\Component\Security\Http\RememberMe\ResponseListener::onKernelResponse()              0
  #6      Symfony\Component\HttpKernel\EventListener\ProfilerListener::onKernelResponse()              -100
  #7      Symfony\Component\HttpKernel\EventListener\ErrorListener::removeCspHeader()                  -128
  #8      Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener::onKernelResponse()   -128      
  #9      Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener::onResponse()      -255
  #10     Symfony\Component\HttpKernel\EventListener\SessionListener::onKernelResponse()               -1000
  #11     Symfony\Component\HttpKernel\EventListener\StreamedResponseListener::onKernelResponse()      -1024
 ------- -------------------------------------------------------------------------------------------- ----------

Grace au contener de service, il connais donc quand il vat allée sur le PrenonSubscriber.php
Il vat remarquer qu'il y a un EventSubscriber donc il vas inscrire c'est classe dans EventDispacher.
Nous n'avons plus besion d'écrire dans le service.yaml. Il suffit de l'écrire dirrectement dans le php.
Dans la page web de la barre symfony nous voyons toujours la cible avec le dump test1 et teste2.

Tout sa fonction grace a: autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
Qui se trouve dans le service.yaml.
Si le desactivons pour PrenomSubscriber.php dans le sevice.yaml.
App\EventDispatcher\PrenomSubscriber:
        autoconfigure: false

Il devient indisponible, malger qu'il soit rensseigner dans le fichier PrenomSubscriber.php.

Registered Listeners for "kernel.response" Event
================================================

 ------- -------------------------------------------------------------------------------------------- ---------- 
  Order   Callable                                                                                     Priority  
 ------- -------------------------------------------------------------------------------------------- ----------
  #1      Symfony\Component\HttpKernel\EventListener\ResponseListener::onKernelResponse()              0
  #2      Symfony\Component\HttpKernel\DataCollector\RequestDataCollector::onKernelResponse()          0
  #3      Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener::onKernelResponse()       0
  #4      Symfony\Component\Security\Http\RememberMe\ResponseListener::onKernelResponse()              0
  #5      Symfony\Component\HttpKernel\EventListener\ProfilerListener::onKernelResponse()              -100
  #6      Symfony\Component\HttpKernel\EventListener\ErrorListener::removeCspHeader()                  -128
  #7      Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener::onKernelResponse()   -128
  #8      Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener::onResponse()      -255
  #9      Symfony\Component\HttpKernel\EventListener\SessionListener::onKernelResponse()               -1000
  #10     Symfony\Component\HttpKernel\EventListener\StreamedResponseListener::onKernelResponse()      -1024
 ------- -------------------------------------------------------------------------------------------- ----------

<h3>Premier récapitulatif</h3>

<h3>Créons et propageons notre propre événement : le PurchaseEvent</h3>

Nous allons créer un évenement qui, quand une commande est passé, un email sera envoyé au développer.
Dans le PurchasePayementSuccessController.php nous allons mettre en place 

Creation du dossier Event et dans ce dossier créons PurchaseSucessEvent.php
Dans le quelle on vas lui passé l'Event.

<?php

namespace App\Event;

use App\Entity\Purchase;
use Symfony\Contracts\EventDispatcher\Event;

class PurchaseSuccessEvent extends Event
{
    private $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }
}

Dans le fichier Purchase PurchasePayementSuccessController.php
//Lancer un événement qui permettre aux autre développer de reagir à la prise d'une commande.
//Comment emettre un événement grace à l'EventeDispatcherInterface.

<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Event\PurchaseSuccessEvent;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PurchasePaymentSuccessController extends AbstractController
{
    /**
     * @Route("/purchase/terminate/{id}", name="purchase_payment_success")
     * @IsGranted("ROLE_USER")
     */
    public function index($id, PurchaseRepository $purchaseRepository, EntityManagerInterface $em, CartService $cartService, EventDispatcherInterface $dispatcher)
    {


        //1. Je récupère la commande
        $purchase = $purchaseRepository->find($id);


        if (
            !$purchase ||
            ($purchase && $purchase->getUser() !== $this->getUser()) ||
            ($purchase && $purchase->getStatus() === Purchase::STATUS_PAID)
        ) {
            $this->addFlash('warning', "La commande n'existe pas");
            return $this->redirectToRoute("purchase_index");
        }
        //2. Je la fait passer au status PAYEE (PAID)
        $purchase->setStatus(Purchase::STATUS_PAID);
        $em->flush();

        //3. Je vide le panier
        $cartService->empty();

        //Lancer un événement qui permettre aux autre développer de reagir à la prise d'une commande.
        //Comment emettre un événement grace à l'EventeDispatcherInterface.
        $purchaseEvent = new PurchaseSuccessEvent($purchase);
        $dispatcher->dispatch($purchaseEvent, 'purchase.success');


        //4. Je redirige avec un flash vers la liste des commandes
        $this->addFlash('success', "La commande a été payée et confirmée !");
        return $this->redirectToRoute("purchase_index");
    }
}

<h3>Création d'un Subscriber qui enverra des emails</h3>

Creation s'un fichier PurchaseSuccessEmailSubscriber.php dans le dossier EventDispatcher.

<?php

namespace App\EventDispatcher;

use App\Event\PurchaseSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PurchaseSuccessEmailSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'purchase.success' => 'sendSuccessEmail',
        ];
    }

    public function sendPurchaseSuccessEmail(PurchaseSuccessEvent $purchaseSuccessEvent)
    {
        dd($purchaseSuccessEvent);
    }
}

Nous voyons que notre evennemt est maintenant disponnible.
php bin/console debug:event-dispatcher purchase.success

Registered Listeners for "purchase.success" Event
=================================================

 ------- ----------------------------------------------------------------------- ----------
  Order   Callable                                                                Priority 
 ------- ----------------------------------------------------------------------- ----------
  #1      App\EventDispatcher\PurchaseSuccessEmailSubscriber::sendSucessEmail()   0
 ------- ----------------------------------------------------------------------- ----------

Reprenon le processus de validation de la commande et de la confirmation de la commande.
Une fois le paiement effectué, nous allons envoyer un email au développeur.
Voici le retour du dd($purchaseSuccessEvent);

PurchaseSuccessEmailSubscriber.php on line 21:
App\Event\PurchaseSuccessEvent {#380 ▼
  -purchase: App\Entity\Purchase {#540 ▼
    -id: 159
    -FullName: "toto popo"
    -address: "10, rue de la marne"
    -postalCode: "78000"
    -city: "Paris"
    -total: 25638
    -status: "PAID"
    -user: App\Entity\User {#723 ▼
      -id: 44
      -email: "user0@gmail.com"
      -roles: []
      -password: "$argon2id$v=19$m=65536,t=4,p=1$YWdBNE9UMFkwZUtFQVFVbQ$rqwg27WnFU/QrqzPmpTkKSP811q4GBtvwVg6rSoSABk"
      -fullName: "Michelle Normand"
      -categories: Doctrine\ORM\PersistentCollection {#535 ▶}
      -purchases: Doctrine\ORM\PersistentCollection {#599 ▶}
    }
    -purchasedAT: DateTime @1636735228 {#528 ▶}
    -purchaseItems: Doctrine\ORM\PersistentCollection {#510 ▶}
  }
  -propagationStopped: false
}

Nous retrouvons tout les informationd pour construire le mail de confirmation.
Ma purchase et mon utilisateur sont disponible avec le purchaseItem.

Le PurchaseSuccessEmailSubscriber fait partie du container de service, peu se faire livrais des services.
Avec l'injection de dépendance, nous appelerons le loggerInterface

<?php

namespace App\EventDispatcher;


use Psr\Log\LoggerInterface;
use App\Event\PurchaseSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PurchaseSuccessEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;

    public function __construct(LoggerInterface $loger)
    {
        $this->logger = $loger;
    }



    public static function getSubscribedEvents()
    {
        return [
            'purchase.success' => 'sendSuccessEmail'
        ];
    }

    public function sendSuccessEmail(PurchaseSuccessEvent $purchaseSuccessEvent)
    {
        $this->logger->info("Email envoyé pour la commande n°" . $purchaseSuccessEvent->getPurchase()->getId());
    }
}

[Application] Nov 12 16:53:52 |INFO   | APP    Email envoyé pour la commande n°160







