<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class DunningPlan extends Model
{
    use Collection;

    public string $name;
    public array $schedule;
    public string $handle;
    public string $state;
    public string $created;
    public bool $default_plan;
    public string $final_subscription_action;
    public string $grace_period;
    public bool $no_grace_hard_decline;
}
