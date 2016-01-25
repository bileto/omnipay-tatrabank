<?php

namespace Omnipay\Tatrabank\Message;

class PurchaseResponse extends AbstractRedirectResponse
{
    protected function getSignatureKeys()
    {
        return ['MID', 'AMT', 'CURR', 'VS', 'RURL', 'IPC', 'NAME', 'TIMESTAMP'];
    }

}
