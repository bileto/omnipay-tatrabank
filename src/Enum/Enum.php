<?php

namespace Omnipay\Tatrabank\Enum;

/**
 * Enumeration
 *
 * @author Petr "BAGR" Smrkovský <bagr42@gmail.com>
 */
abstract class Enum
{
    protected static $def = [];

    /**
     * @param mixed $name
     * @return mixed
     * @throws \UnexpectedValueException
     */
    public static function getValue($name)
    {
        if(!isset(static::$def[$name])) {
            throw new \UnexpectedValueException('Name "' . $name . '" is not in enumeration');
        }
        return static::$def[$name];
    }

    /**
     * @param mixed $value
     * @return mixed
     * @throws \UnexpectedValueException
     */
    public static function getName($value)
    {
        $result = array_search($value, static::$def, true);
        if($result === FALSE) {
            throw new \UnexpectedValueException('Value "' . $value . '" is not in enumeration');
        }
        return $result;
    }

    /**
     * @return array
     */
    public static function getNames()
    {
        return array_keys(static::$def);
    }

    /**
     * @return array
     */
    public static function getValues()
    {
        return array_values(static::$def);
    }

}
