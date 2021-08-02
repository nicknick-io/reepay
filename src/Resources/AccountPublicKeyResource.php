<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\AccountPublicKey;

class AccountPublicKeyResource extends Resource
{
    public function all()
    {
        return AccountPublicKey::collection($this->connection->get('account/pubkey'));
    }
}
