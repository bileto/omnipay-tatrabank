<?php

require '../vendor/autoload.php';

use Guzzle\Http\Exception\ClientErrorResponseException;
use Omnipay\Tatrabank\GatewayFactory;

$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$id = $_ENV['ID'];
$key = $_ENV['KEY'];

$gateway = GatewayFactory::createInstance($id, $key);

try {
    $orderNo = uniqid();
    $returnUrl = 'http://localhost:8000/gateway-return.php';
    $notifyUrl = 'http://127.0.0.1/online-payments/uuid/notify';
    $description = 'Shopping at myStore.com';

    $parameters = [
        'customerId'    => '42',
        'transactionId' => '12345',
        'amount'        => 6.0,
        'currency'      => 'EUR',
        'clientIp'      => '1.2.3.4',
        'returnUrl'     => $returnUrl,
        'language'      => 'CZ',
    ];


    $response = $gateway->purchase($parameters)->send();

    echo 'Our OrderNo: ' . $orderNo . PHP_EOL;
    echo "TransactionId: " . $response->getTransactionId() . PHP_EOL;
    echo "TransactionReference: " . $response->getTransactionReference() . PHP_EOL;
    echo 'Is Successful: ' . (bool) $response->isSuccessful() . PHP_EOL;
    echo 'Is redirect: ' . (bool) $response->isRedirect() . PHP_EOL;
    echo 'Additional data: ' . var_export($response->getData());

    // Payment init OK, redirect to the payment gateway
    echo $response->getRedirectUrl() . PHP_EOL;
} catch (ClientErrorResponseException $e) {
    dump((string)$e);
    dump($e->getResponse()->getBody(true));
}