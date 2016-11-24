<?php

namespace Omnipay\Tatrabank\Sign;

class Signator
{
    /** @var string */
    private $secureKey;

    function __construct($secureKey)
    {
        $this->secureKey = $secureKey;
    }

    /**
     * @param string $text
     * @return string
     */
    public function sign($text)
    {
        return hash_hmac("sha256", $text, pack('H*', $this->secureKey));
    }
}