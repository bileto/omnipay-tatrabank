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

    protected function getSignatureKeys()
    {
        return ['AMT', 'CURR', 'VS', 'RES', 'AC', 'TID', 'TIMESTAMP'];
    }

}