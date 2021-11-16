<?php

namespace App\Doctrine\Listener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductSlugListener
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Product $entity, LifecycleEventArgs $event)
    {

        if (empty($entity->getSlug())) {
            // SluggerInterface creation du slug par rapport au getName()
            $entity->setSlug(strtolower($this->slugger->slug($entity->getName())));
        }
    }
}
