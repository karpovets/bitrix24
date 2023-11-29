<?php

namespace Test\App\UserSection;

class User
{
    /**
     * @param int $userId
     * @return array
     */
    public static function getUserNameVowels(int $userId): string
    {
        $userData =  '';
        $vowels = "AEIOUY";

        if ($userId > 0)
        {
            $params = [
                'filter' => ['=ID' => $userId, 'ACTIVE'=> 'Y'],
                'select' => ['NAME', 'LAST_NAME', 'SECOND_NAME'],
                'cache' => ['ttl' => 3600]
            ];

            if ($user = \Bitrix\Main\UserTable::getRow($params))
            {
                foreach ($user as $code=> $val) {
                    $userData .= self::getVowelsLetters($val);
                }
            }
        }

        return $userData;
    }

    /**
     * @param string $word
     * @return string
     */
    private static function getVowelsLetters(string $word): string
    {
        $vowelsValue = '';
        $vowels = ['a','e','i','o','u', 'а', 'у', 'о', 'и', 'э', 'ы', 'і'];
        $word = \ToLower($word);
        foreach (mb_str_split($word) as $letter) {
            if (in_array($letter, $vowels))
                $vowelsValue .= $letter;
        }

        return $vowelsValue;
    }
}