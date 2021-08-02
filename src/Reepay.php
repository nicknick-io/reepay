<?php
namespace NickNickIO\Reepay;

use NickNickIO\Reepay\Resources\{
    PlanResource
};

class Reepay
{

    /**
     * @var PlanResource
     */
    public PlanResource $plan;


    /**
     * Reepay constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $connection = new Connection($token);

        $this->plan = new PlanResource($connection);
    }

}
