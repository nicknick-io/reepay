<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\AccountMail;

class AccountMailResource extends Resource
{
    public function get()
    {
        return new AccountMail($this->connection->get('account/mail_settings'));
    }
}
