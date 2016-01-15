<?php

namespace Omnipay\Tatrabank\Enum;

/**
 * Currencies
 *
 * @author Petr "BAGR" Smrkovský <bagr42@gmail.com>
 */
class Currency extends Enum
{
    protected static $def = [
        'CZK' => 203,
        'EUR' => 978,
        'USD' => 840,
        'GBP' => 826,
        'PLN' => 985,
        'HUF' => 348,
        'CHF' => 756,
        'DKK' => 208
    ];
}
