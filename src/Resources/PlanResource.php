<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\Plan;

class PlanResource extends Resource
{

    /**
     * @return Plan
     */
    public function all(array $parameters = [])
    {
        return Plan::collection($this->connection->get('plan', $parameters));
    }
}
