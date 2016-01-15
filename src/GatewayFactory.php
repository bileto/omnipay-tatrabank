<?php

namespace Omnipay\Tatrabank;

use Omnipay\Tatrabank\Sign\DataSignator;
use Omnipay\Tatrabank\Sign\Preparer;
use Omnipay\Tatrabank\Sign\Signator;
use Omnipay\Omnipay;

class GatewayFactory
{
    /**
     * @param string $secureKey
     * @return Gateway
     */
    public static function createInstance($secureKey)
    {
        $preparer = new Preparer();
        $signator = new Signator($secureKey);
        $dataSignator = new DataSignator($preparer, $signator);

        /** @var \Omnipay\Tatrabank\Gateway $gateway */
        $gateway = Omnipay::create('Tatrabank');
        $gateway->setSignator($dataSignator);
        return $gateway;
    }
}