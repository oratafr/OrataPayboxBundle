<?php

namespace Orata\Bundle\PayboxBundle\Paybox\System;

/**
 * Class Tools
 *
 * @package Orata\Bundle\PayboxBundle\Paybox\System
 *
 */
class Tools
{
    /**
     * Makes an array of parameters become a querystring like string.
     *
     * @param  array $array
     *
     * @return string
     */
    static public function stringify(array $array)
    {
        $result = array();

        foreach ($array as $key => $value) {
            $result[] = sprintf('%s=%s', $key, $value);
        }

        return implode('&', $result);
    }
}
