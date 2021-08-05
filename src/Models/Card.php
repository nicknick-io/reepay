<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class Card extends Model
{
    use Collection;

    public string $id;
    public string $state;
    public string $customer;
    public string $reference;
    public string $failed;
    public string $created;
    public string $fingerprint;
    public string $reactivated;
    public string $gw_ref;
    public string $card_type;
    public string $exp_date;
    public string $masked_card;
    public string $last_success;
    public string $last_failed;
    public string $error_code;
    public string $error_state;
    public string $strong_authentication_status;
    public string $three_d_secure_status;
    public string $risk_rule;
    public string $card_country;
}
