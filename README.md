## Info

Momo payment driver for [Omnipay League](https://github.com/thephpleague/omnipay).

Introduce about **Omnipay** gateways, read [here](https://omnipay.thephpleague.com/) 
for reference

## Installation

Via [Composer](https://getcomposer.org):

```bash
composer require gemfourmedia/omnipay-momo
```
## Usage

### Initialize

Please read MoMo documentation [here](https://developers.momo.vn/v3/vi/docs/payment/onboarding/overall)

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('MoMo');
$gateway->initialize([
    'accessKey' => 'Provided by MoMo',
    'partnerCode' => 'Provided by MoMo',
    'secretKey' => 'Provided by MoMo',
]);
```

### Purchase Request:

```php
$response = $gateway->purchase([
    'amount' => 20000,
    'redirectUrl' => 'https://yourdomain.com/payment-success',
    'ipnUrl' => 'https://yourdomain.com/ipn',
    'orderId' => 'unique id', // eg: 9
    'requestType' => 'captureWallet', // captureWallet|payWithATM|payWithCC
    'lang' => 'vi', // vi|en
    'orderInfo' => '',
    'requestId' => (string) \Str::uuid(), // eg: da584fe0-0fe3-47c6-ad20-19ad3e050140
    'extraData' => base64_encode(json_encode([])),
])->send();

if ($response->isRedirect()) {
    $redirectUrl = $response->getRedirectUrl();
    
    // TODO: Redirect to MoMo Payment page
}
```

For more parameters, read [here](https://developers.momo.vn/v3/docs/payment/api/wallet/onetime#api-configuration).

### Complete Purchase (handle respone data when MoMo redirect back to your site):

```php
$response = $gateway->completePurchase()->send();

if ($response->isSuccessful()) {
    print $response->amount;
    print $response->orderId;
    
    var_dump($response->getData());
    
} else {

    print $response->getMessage();
}
```

For more parameters, read [here](https://developers.momo.vn/v3/docs/payment/api/wallet/onetime#processing-payment-result).

### MoMo IPN (Instant Payment Notification) handler:

```php
$response = $gateway->notification()->send();

if ($response->isSuccessful()) {
    
    print $response->amount;
    print $response->orderId;
    
    // Get all MoMo respone data.
    var_dump($response->getData()); 
    
} else {

    print $response->getMessage();
}
```

For more respone parameters, read [here](https://developers.momo.vn/v3/docs/payment/api/result-handling/notification/).

### Query Transaction (Check Transaction Status):

```php

$response = $gateway->queryTransaction([
    'orderId' => '9',
    'requestId' => 'da584fe0-0fe3-47c6-ad20-19ad3e050140',
    'lang' => 'vi',
])->send();

if ($response->isSuccessful()) {
    // TODO: handle result.
    print $response->amount;
    print $response->orderId;
    
    var_dump($response->getData()); // All momo response data
    
} else {

    print $response->getMessage();
}
```

For more parameters, read [here](https://developers.momo.vn/v3/vi/docs/payment/api/payment-api/query).

### Refund:

```php
$response = $gateway->refund([
    'orderId' => 'refund-10', //Note: orderId (new) of the refund transaction which must be different from orderId of the original purchase transaction
    'requestId' => '1f60e60a-a78c-45c0-b6da-94d1855157ae',
    'amount' => 2100,
    'transId' => 2842402931,
    'lang' => 'vi',
    'description' => 'Example refund 10',
])->send();

if ($response->isSuccessful()) {
    var_dump($response->getData());
    
} else {

    print $response->getMessage();
}
```

For more respone parameters, read [here](https://developers.momo.vn/v3/docs/payment/api/payment-api/refund/#http-request).

### Query Refund Status:

```php
$response = $gateway->queryRefund([
    'orderId' => 'refund-10',
    'requestId' => '1f60e60a-a78c-45c0-b6da-94d1855157ae',
    'lang' => 'vi',
])->send();

if ($response->isSuccessful()) {
    
    var_dump($response->getData());
    
} else {

    print $response->getMessage();
}
```

For more respone parameters, read [here](https://developers.momo.vn/v3/docs/payment/api/payment-api/refund/#http-response-1).

### Debug:

```php
    print $response->getCode(); // Get result code from MoMo.
    print $response->getMessage(); // Get message .
```

Result code reference `getCode()` read [here](https://developers.momo.vn/v3/docs/payment/api/result-handling/resultcode).
