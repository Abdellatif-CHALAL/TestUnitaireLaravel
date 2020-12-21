<?php

namespace App\Service;

class AwesomeService implements ToDoLostServiceInterface
{
    public function add()
    {
        // if ($item->isValid() && $user->isValid()) {
        //     return true;
        // }
        return "je suis dans le service provider";
    }
}
