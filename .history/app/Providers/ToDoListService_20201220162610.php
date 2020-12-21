<?php

namespace App\Service;

class AwesomeService implements AwesomeServiceInterface
{
    public function add(User $user, Item $item)
    {
        if ($item->isValid() && $user->isValid()) {
            return true;
        }
        return false;
    }
}
