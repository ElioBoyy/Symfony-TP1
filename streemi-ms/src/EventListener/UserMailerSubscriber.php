<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsEntityListener(event: Events::prePersist, entity: User::class)]
readonly class UserMailerSubscriber
{
    public function __construct(
        protected MailerInterface $mailer
    )
    {
    }

    public function prePersist(User $user): void
    {
        $email = (new Email())
            ->from('streemi.noreply@gmail.com')
            ->to($user->getEmail())
            ->subject('Bienvenue sur notre site')
            ->text('Merci de vous être inscrit sur notre site.');

        $this->mailer->send($email);
    }
}
