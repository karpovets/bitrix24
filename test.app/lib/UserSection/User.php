<?php

namespace Test\App\UserSection;

class User
{
    /**
     * @param int $userId
     * @return array
     */
    public static function getUserNameVowels(int $userId): array
    {
        $userData =  [];

        if ($userId > 0)
        {
            $params = [
                'filter' => ['=ID' => $userId],
                'select' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME']
            ];

            if ($user = \Bitrix\Main\UserTable::getRow($params))
            {
                foreach ($user as $code=> $val) {
                    $userData[\ToLower($code)] = $val;
                }
            }
        }

        return $userData;
    }
}