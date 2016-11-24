<?php

namespace Omnipay\Tatrabank\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    protected function getSignatureKeys()
    {
        return [];
    }

    public function setData($value)
    {
        return $this->setParameter('data', $value);
    }

    public function getData()
    {
        $this->validate('data');

        return $this->getParameter('data');
    }

    public function sendData($data)
    {
        $data['HMAC'] = $this->getSignator()->sign($data, ['AMT', 'CURR', 'VS', 'RES', 'AC', 'TID', 'TIMESTAMP']);

        return $this->createResponse(CompletePurchaseResponse::class, $data);
    }
}