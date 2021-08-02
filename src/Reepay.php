<?php
namespace NickNickIO\Reepay;

use NickNickIO\Reepay\Resources\{AccountResource, PlanResource};

class Reepay
{

    /**
     * @var PlanResource
     */
    public PlanResource $plan;

    /**
     * @var AccountResource
     */
    public AccountResource $account;


    /**
     * Reepay constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $connection = new Connection($token);

        $this->plan = new PlanResource($connection);
        $this->account = new AccountResource($connection);
    }

}
