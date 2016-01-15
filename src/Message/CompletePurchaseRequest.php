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
        return $this->createResponse(CompletePurchaseResponse::class, $data);
    }
}