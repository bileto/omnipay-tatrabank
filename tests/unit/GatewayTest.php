<?php

use Omnipay\Tatrabank\GatewayFactory;

class GatewayTest extends PHPUnit_Framework_TestCase
{
    private $secureKey = '3132333435363738393031323334353637383930313233343536373839303132';

    public function testPurchase()
    {
        $gateway = GatewayFactory::createInstance($this->secureKey);

        $parameters = [
            'merchantId' => '9999',
            'customerId' => '42',
            'transactionId' => '12345',
            'amount' => 6.0,
            'currency' => 'EUR',
            'clientIp' => '1.2.3.4',
            'returnUrl' => 'http://example.com',
            'language' => 'CZ',
            'description' => 'Test'
        ];

        $response = $gateway->purchase($parameters)->send();

        $this->assertInstanceOf(Omnipay\Tatrabank\Message\AbstractRedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('https://moja.tatrabanka.sk/cgi-bin/e-commerce/start/e-commerce.jsp', $response->getRedirectUrl());
        $this->assertEquals(
            [
                'MID' => '9999',
                'AMT' => '6.00',
                'CURR' => '978',
                'VS' => '12345',
                'RURL' => 'http://example.com',
                'IPC' => '1.2.3.4',
                'NAME' => '42',
                'TPAY' => 'N',
                'AREDIR' => '1',
                'DESC' => 'Test',
                'LANG' => 'cz',
                'SIGN' => 'DB477E907B1CF9F7D85D2542913CBEC5'
            ],
            $response->getRedirectData()
        );
    }



    public function testCompletePurchase()
    {
        $gateway = GatewayFactory::createInstance($this->secureKey);

        $parameters = [
            'data' => [
                'VS' => '12345',
                'RES' => 'OK',
                'AC' => '123456',
                'SIGN' => '7F51F02B2C4A1A8D32641D44E77DEE97'
            ]
        ];

        $response = $gateway->completePurchase($parameters)->send();

        $this->assertInstanceOf(Omnipay\Tatrabank\Message\AbstractResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('12345', $response->getTransactionId());
        $this->assertEquals('123456', $response->getApprovalCode());
    }

}
