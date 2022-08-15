<?php

require 'vendor/autoload.php';

use NickNickIO\Reepay\Reepay;
$reepay = new Reepay('pr875894628754bhjvhjdsbhj');

echo '<pre>';
var_dump($reepay->customer->payment_method->all('cust-0001'));
var_dump($reepay->customer->get('cust-0001'));
var_dump($reepay->customer->all([
    'page' => 1,
    'size' => 50
]));
