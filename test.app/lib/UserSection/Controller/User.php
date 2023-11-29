<?php

namespace Test\App\UserSection\Controller;

use Bitrix\Main\Engine\Controller;

class User extends Controller
{
    public function getUserNameVowelsAction()
    {
        $request = $this->getRequest();
        $userId = $request->get('id');
        $userData =  [];

        if ($userId > 0) {
            $userData = \Test\App\UserSection\User::getUserNameVowels((int)$userId);
        }

        return $userData;
    }
}