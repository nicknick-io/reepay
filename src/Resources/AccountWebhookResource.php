<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\AccountWebhook;

class AccountWebhookResource extends Resource
{
    public function get()
    {
        return new AccountWebhook($this->connection->get('account/webhook_settings'));
    }

    public function regenerate()
    {
        return new AccountWebhook($this->connection->post('account/webhook_settings/secret'));
    }
}
