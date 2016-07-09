<?php

namespace Omnipay\Tatrabank\Message;

class CompletePurchaseResponse extends AbstractResponse
{
    public function getApprovalCode()
    {
        if (isset($this->data['AC'])) {
            return $this->data['AC'];
        }
    }

    public function getTransactionReference()
    {
        if (isset($this->data['VS'])) {
            return $this->data['VS'];
        }
    }


    protected function getSignatureKeys()
    {
        return ['AMT', 'CURR', 'VS', 'RES', 'AC', 'TID', 'TIMESTAMP'];
    }

}