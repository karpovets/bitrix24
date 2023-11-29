<?php

namespace Test\App\UserSection\Rest;

use Test\App\UserSection\User;

class UserRest
{
    public static function OnRestServiceBuildDescription()
    {
        return array(
            'user' => array(
                'get.username.vowels' => array(
                    'callback' => array(__CLASS__, 'getUserNameVowels'),
                    'options' => array(),
                ),
            )
        );
    }

    public static function getUserNameVowels($query, $n, \CRestServer $server)
    {
        $userData = [];

        if($query['error'])
        {
            throw new \Bitrix\Rest\RestException(
                'Message',
                'ERROR_CODE',
                \CRestServer::STATUS_PAYMENT_REQUIRED
            );
        }

        if ($query['id']) {
            $userData = User::getUserNameVowels((int)$query['id']);
        }

        return $userData;
    }
}