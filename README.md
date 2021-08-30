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

-------------------------------------------
Doctrine et les bases de données
7-composer require doctrine
https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/index.html
https://symfony.com/doc/current/doctrine.html
7-1-php bin/console doctrine:database:create ou d:d:c
https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/index.html
https://symfony.com/doc/current/doctrine.html 
https://symfony.com/doc/3.1/bundles/DoctrineMigrationsBundle/index.html
Créer une entité Product et la migration qui va avec
7-2-composer require maker
Création d'une entity
7-3-php bin/console make:entity
Création du fichier de migration
7-3-1-php bin/console make:migration
Migration du fichier version dans la base de donnée
7-3-2-php bin/console doctrine:migrations:migrate

Modification d'une entity déjà existante appelé "exp:Product"
7-5-php bin/console make:entity Product

Controle du repository
7-6-php bin/console debug:autowiring --all repository