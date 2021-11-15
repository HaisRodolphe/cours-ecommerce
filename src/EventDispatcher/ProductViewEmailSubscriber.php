<?php

namespace App\EventDispatcher;

use App\Event\ProductViewEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductViewEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;

    public function __construct(LoggerInterface $loger)
    {
        $this->logger = $loger;
    }

    public static function getSubscribedEvents()
    {
        return [
            'product.view' => 'sendEmail',
        ];
    }

    public function sendEmail(ProductViewEvent $productViewEvent)
    {
        $this->logger->info("Email envoyé à l'admin pour le produit" . $productViewEvent->getProduct()->getId());
    }
}
