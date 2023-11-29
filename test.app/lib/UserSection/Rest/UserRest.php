<?php

namespace Test\App\UserSection\Rest;

use Test\App\UserSection\User;
use Bitrix\Rest\RestException;

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

        if (!$query['id']) {
            throw new RestException(
                'id is not defined or invalid',
                'ERROR_CODE',
                \CRestServer::STATUS_WRONG_REQUEST
            );
        }

        $userData = User::getUserNameVowels((int)$query['id']);

        if (empty($userData)) {
            throw new RestException(
                'Not found',
                'ERROR_CODE',
                \CRestServer::STATUS_WRONG_REQUEST
            );
        }

        return $userData;
    }
}