<?php
/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

namespace Zwig\Util;


/**
 * Class that generates unique identifiers.
 */
abstract class UniqueID
{
    private static $previouslyGeneratedIdentifier = [];


    /**
     * @param string $name
     * @return string
     */
    public static function fromFunctionName($name)
    {
        // Delete everything that is no letter, digit, underscore, slash and backslash
        $identifier = preg_replace('([^\w/\\\])', '', $name);
        // Replace directory separators with two underscores
        $identifier = preg_replace('([/\\\])', '__', $identifier);

        return $identifier;
    }

    /**
     * @param string $prefix
     * @return string
     */
    public static function withPrefix($prefix)
    {
        $identifier = $prefix . self::getRandomIdentifier(32 - strlen($prefix));

        if (in_array($identifier, self::$previouslyGeneratedIdentifier)) {
            return self::withPrefix($prefix);
        }

        self::$previouslyGeneratedIdentifier[] = $identifier;

        return $identifier;
    }

    /**
     * @param int $length
     * @return string
     */
    private static function getRandomIdentifier($length = 32)
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $alphabetMax = strlen($alphabet) - 1;

        $identifier = '';
        while (strlen($identifier) < $length) {
            // The function random_int was added in PHP 7.0
            if (function_exists('random_int')) {
                $random = random_int(0, $alphabetMax);
            } else {
                $random = mt_rand(0, $alphabetMax);
            }

            $identifier .= $alphabet[$random];
        }

        return $identifier;
    }
}