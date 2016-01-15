<?php

namespace Omnipay\Tatrabank\Message;

use Omnipay\Tatrabank\Gateway;

abstract class AbstractRedirectResponse extends AbstractResponse implements \Omnipay\Common\Message\RedirectResponseInterface
{

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return Gateway::getEndpoint();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }

}