<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PartenaireSubscriber implements EventSubscriberInterface
{
    public function onPartenaire($event)
    {
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
            'Partenaire' => 'onPartenaire',
        ];
    }
}
