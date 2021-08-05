<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class MpsSubscription extends Model
{
    use Collection;

    public string $id;
    public string $state;
    public string $customer;
    public string $reference;
    public string $failed;
    public string $created;
    public string $external_id;
}
