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
    public function sign($text) {
        if (!extension_loaded('mcrypt')) {
			throw new \RuntimeException('PHP extension "mcrypt" is required');
        }

		return strtoupper(bin2hex(mcrypt_encrypt(
            MCRYPT_RIJNDAEL_128,
            pack('H*', $this->secureKey),
            substr(sha1($text, true), 0, 16),
            MCRYPT_MODE_ECB
        )));
    }
}