# Base32

基於 [RFC 4648](https://datatracker.ietf.org/doc/html/rfc4648) 的 Base32 編碼與解碼

## 要求

- PHP >= 8.1

# 安裝

```shell
composer require mika/base32 "^1.0"
```

## 用法

```php
<?php

use Mika\Base32\Base32;

$encodedString = Base32::encode('foobar'); // 'MZXW6YTBOI======'

$decodedString = Base32::decode($encodedString); // 'foobar'
```
