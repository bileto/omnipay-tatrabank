# Omnipay: TatraBank

**TatraBank driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements TatraBank Online Payment Gateway support for Omnipay.

## Docs
[CardPay (SK)](http://www.tatrabanka.sk/cardpay/CardPay_technicka_prirucka_HMAC.pdf)

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "bileto/omnipay-tatrabank": "~0.2"
    }
}
```
## TL;DR
```php
use Omnipay\Tatrabank\GatewayFactory;

$secureKey = "3132333435363738393031323334353637383930313233343536373839303132";
$gateway = GatewayFactory::createInstance($secureKey);

try {
    $merchantId = 'A1029DTmM7';
    $orderNo = '12345677';
    $returnUrl = 'http://localhost:8000/gateway-return.php';
    $description = 'Shopping at myStore.com (Lenovo ThinkPad Edge E540, Shipping with PPL)';

    $purchase = new \Omnipay\Csob\Purchase($merchantId, $orderNo, $returnUrl, $description);
    $purchase->setCart([
        new \Omnipay\Csob\CartItem("Notebook", 1, 1500000, "Lenovo ThinkPad Edge E540..."),
        new \Omnipay\Csob\CartItem("Shipping", 1, 0, "PPL"),
    ]);

    /** @var \Omnipay\Csob\Message\ProcessPaymentResponse $response */
    $response = $gateway->purchase($purchase->toArray())->send();

    // Payment init OK, redirect to the payment gateway
    echo $response->getRedirectUrl();
} catch (\Exception $e) {
    dump((string)$e);
}
```
