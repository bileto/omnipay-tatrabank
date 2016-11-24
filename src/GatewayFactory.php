<?php

namespace Omnipay\Tatrabank;

use Omnipay\Omnipay;
use Omnipay\Tatrabank\Sign\DataSignator;
use Omnipay\Tatrabank\Sign\Preparer;
use Omnipay\Tatrabank\Sign\Signator;

class GatewayFactory
{
    /**
     * @param string $id
     * @param string $key
     * @return Gateway
     */
    public static function createInstance($id, $key)
    {
        $preparer = new Preparer();
        $signator = new Signator($key);
        $dataSignator = new DataSignator($preparer, $signator);

        /** @var \Omnipay\Tatrabank\Gateway $gateway */
        $gateway = Omnipay::create('Tatrabank');
        $gateway->setMerchantId($id);
        $gateway->setSignator($dataSignator);

        return $gateway;
    }
}