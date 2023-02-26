<?php

namespace App\EventListener;

use Symfony\Contracts\EventDispatcher\Event;

class UserRegisteredListener {

    public function onUserRegistred(Event $event) {
        echo $event->getUser()->getName();
    } 

}