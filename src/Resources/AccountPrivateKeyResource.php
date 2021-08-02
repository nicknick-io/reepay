<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\AccountPrivateKey;

class AccountPrivateKeyResource extends Resource
{
    public function all()
    {
        return AccountPrivateKey::collection($this->connection->get('account/privkey'));
    }
}
