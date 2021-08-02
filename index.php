<?php

require 'vendor/autoload.php';

use NickNickIO\Reepay\Reepay;
$reepay = new Reepay('priv_205af8d8805bc6037a000749154baff7');
echo '<pre>';
var_dump($reepay->plan->all(['only_active' => 'true']));

