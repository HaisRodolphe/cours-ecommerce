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







