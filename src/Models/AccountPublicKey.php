<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class AccountPublicKey extends Model
{
    use Collection;

    public string $key;
    public string $created;
}
