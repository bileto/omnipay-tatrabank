<?php

namespace Omnipay\Tatrabank\Message;

use Omnipay\Tatrabank\Sign\DataSignator;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /** @var DataSignator */
    private $signator;

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

    /**
     * @return DataSignator
     */
    public function getSignator()
    {
        return $this->signator;
    }

    protected function createResponse($class, $data)
    {
        $response = new $class($this, $data);
        $response->setSignator($this->getSignator());
        return $response;
    }

}