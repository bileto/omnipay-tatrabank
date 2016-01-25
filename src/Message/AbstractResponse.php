<?php

namespace Omnipay\Tatrabank\Message;

use \Omnipay\Tatrabank\Sign\DataSignator;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /** @var DataSignator */
    private $signator;

    /** @var boolean */
    private $isVerified;

    /**
     * @return array data keys used to generate signature
     */
    abstract protected function getSignatureKeys();

   /**
     * @param DataSignator $signator
     */
    public function setSignator(DataSignator $signator)
    {
        $this->signator = $signator;
    }

    public function isVerified()
    {
        if ($this->isVerified === null) {
            $this->isVerified = $this->verify();
        }
        return $this->isVerified;
    }

    public function isSuccessful()
    {
        if (!$this->isVerified()) {
            return false;
        }
        return $this->getCode() === "OK";
    }

    public function getSignature()
    {
        if (isset($this->data['HMAC'])) {
            return $this->data['HMAC'];
        }
    }

    public function getCode()
    {
        if (isset($this->data['RES'])) {
            return $this->data['RES'];
        }
    }

    public function getTransactionId()
    {
        if (isset($this->data['VS'])) {
            return $this->data['VS'];
        }
    }

    protected function verify()
    {
        return $this->signator->sign($this->getData(), $this->getSignatureKeys()) === $this->getSignature();
    }

}