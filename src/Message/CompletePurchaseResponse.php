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
        if (isset($this->data['TID']) && !empty($this->data['TID'])) {
            return (string) $this->data['TID'];
        }
        return null;
    }

    protected function getSignatureKeys()
    {
        return ['AMT', 'CURR', 'VS', 'RES', 'AC', 'TID', 'TIMESTAMP'];
    }

}