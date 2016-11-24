<?php

namespace Omnipay\Tatrabank\Message;

use Omnipay\Tatrabank\Enum\Currency;
use Omnipay\Tatrabank\Enum\Language;

class PurchaseRequest extends AbstractRequest
{
    protected function getSignatureKeys()
    {
        return ['MID', 'AMT', 'CURR', 'VS', 'RURL', 'IPC', 'NAME', 'TIMESTAMP'];
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    public function getData()
    {
        $this->validate('merchantId', 'customerId', 'transactionId', 'amount', 'currency', 'returnUrl', 'clientIp');

        $data = [
            'MID'       => $this->getMerchantId(),
            'AMT'       => $this->getAmount(),
            'CURR'      => Currency::getValue($this->getCurrency()),
            'VS'        => $this->getTransactionId(),
            'RURL'      => $this->getReturnUrl(),
            'IPC'       => $this->getClientIp(),
            'NAME'      => $this->getCustomerId(),
            'TPAY'      => 'N',
            'AREDIR'    => 1,
            'TIMESTAMP' => str_pad($this->getTimestamp(), 14, "0", STR_PAD_LEFT)
        ];
        if ($this->getLanguage()) {
            $data['LANG'] = Language::getValue($this->getLanguage());
        }
        $data['HMAC'] = $this->getSignator()->sign($data, $this->getSignatureKeys());

        return $data;
    }

    public function sendData($data)
    {
        return $this->createResponse(PurchaseResponse::class, $data);
    }
}
