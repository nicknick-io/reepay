<?php

require 'vendor/autoload.php';

use NickNickIO\Reepay\Reepay;
$reepay = new Reepay('priv_205af8d8805bc6037a000749154baff7');

echo '<pre>';
var_dump($reepay->dunning_plan->get('dunning_plan_2a8e3'));
