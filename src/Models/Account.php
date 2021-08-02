<?php

namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class Account extends Model
{
    use Collection;

    public string $handle;
    public string $currency;
    public string $name;
    public string $address;
    public string $address2;
    public string $city;
    public string $postal_code;
    public string $locale;
    public string $timezone;
    public string $country;
    public string $email;
    public string $phone;
    public string $vat;
    public string $website;
    public string $logo;
    public string $id;
    public string $organisation;
    public string $created;
    public string $state;
    public float $default_vat;
    public string $subscription_invoice_prefix;
}
