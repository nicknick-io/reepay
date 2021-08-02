<?php

require 'vendor/autoload.php';

use NickNickIO\Reepay\Reepay;
$reepay = new Reepay('priv_205af8d8805bc6037a000749154baff7');

echo '<pre>';
var_dump($reepay->account->webhook->get());
var_dump($reepay->account->private_key->all());
var_dump($reepay->account->public_key->all());
var_dump($reepay->account->discount->get());
var_dump($reepay->account->mail->get());
var_dump($reepay->plan->all(['only_active' => 'true']));

