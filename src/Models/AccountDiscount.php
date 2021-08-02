<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class AccountDiscount extends Model
{
    use Collection;

    public string $discount_apply_order;
    public string $discount_percentage_apply;
    public bool $multiple_allowed;
}
