<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\AccountDiscount;

class AccountDiscountResource extends Resource
{
    public function get()
    {
        return new AccountDiscount($this->connection->get('account/discount_settings'));
    }
}
