<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Exceptions\ReepayException;
use NickNickIO\Reepay\Models\DunningPlan;

class DunningPlanResource extends Resource
{

    /**
     * @return array
     * @throws ReepayException
     */
    public function all() : array
    {
        return DunningPlan::collection($this->connection->get('dunning_plan'));
    }

    /**
     * @param string $handle
     * @return DunningPlan
     * @throws ReepayException
     */
    public function get(string $handle) : DunningPlan
    {
        return new DunningPlan($this->connection->get('dunning_plan/' . $handle));
    }

    /**
     * @param string $handle
     * @return DunningPlan
     * @throws ReepayException
     */
    public function delete(string $handle)
    {
        return new DunningPlan($this->connection->delete('dunning_plan/' . $handle));
    }
}
