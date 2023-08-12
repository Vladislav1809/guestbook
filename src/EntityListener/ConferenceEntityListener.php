<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Conference;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\{Event\PrePersistEventArgs, Event\PreUpdateEventArgs, Events};
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Conference::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Conference::class)]
readonly class ConferenceEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    )
    {
    }

    public function prePersist(Conference $conference, PrePersistEventArgs $prePersistEventArgs): void
    {
        $conference->computeSlug($this->slugger);
    }

    public function preUpdate(Conference $conference, PreUpdateEventArgs $preUpdateEventArgs): void
    {
        $conference->computeSlug($this->slugger);
    }

}