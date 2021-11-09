<?php

namespace App\Services;

use Nette\NotImplementedException;

class ConvertKitNewsletter implements Newsletter
{

    public function subscribe(string $email, ?string $list = null)
    {
        // subscribe the user with ConvertKit specific API requests
        throw new NotImplementedException();
    }
}
