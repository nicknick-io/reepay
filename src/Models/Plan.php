<?php

namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class Plan extends Model
{
    use Collection;

    public string $name;
    public string $description;
    public float $vat;
    public int $amount;
    public float $quantity;
    public bool $prepaid;
    public string $handle;
    public float $version;
    public string $state;
    public string $currency;
    public string $created;
    public string $dunning_plan;
    public int $renewal_reminder_email_days;
    public int $trail_reminder_email_days;
    public string $partial_period_handling;
    public bool $include_zero_amount;
    public int $setup_fee;
    public string $setup_fee_text;
    public string $setup_fee_handling;
    public bool $partial_proration_days;
    public int $fixed_trial_days;
    public int $minimum_prorated_amount;
    public bool $amount_incl_vat;
    public int $fixed_count;
    public string $fixed_life_time_unit;
    public int $fixed_life_time_length;
    public string $trial_interval_unit;
    public int $trial_interval_length;
    public int $interval_length;
    public string $schedule_type;
    public int $schedule_fixed_day;
    public int $base_month;
    public int $notice_periods;
    public bool $notice_periods_after_current;
    public int $fixation_periods;
    public bool $fixation_periods_full;
}
