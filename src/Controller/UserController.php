<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\UserRegisteredEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\Event;
use App\EventListener\UserRegisteredListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    protected $em;
    protected $dispatcher;
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $dispatcher) {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    #[Route('/register/{username}', name: 'app_user')]
    public function index($username)
    {
        $user = new User();
        $user->setName("Micky");
        $user->setAge(15);

        // create the UserRegisteredEvent and dispatches it
        $event = new UserRegisteredEvent($user);

        // create listener
        $listener = new UserRegisteredListener();

        // create event dispatch
        $this->dispatcher->dispatch($event, UserRegisteredEvent::NAME);
        
        return $this->render('user/index.html.twig', [
            'username' => $username,
        ]);

    }
}
