<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class AccountWebhook extends Model
{
    use Collection;

    public array $urls;
    public string $username;
    public string $password;
    public bool $disabled;
    public string $secret;
    public array $alert_emails;
    public int $alert_count = 0;
    public array $event_types;
}
