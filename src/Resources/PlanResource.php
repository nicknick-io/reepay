<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\Plan;

class PlanResource extends Resource
{
    /**
     * Get all plans.
     *
     * @param array $parameters
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(array $parameters = [])
    {
        return Plan::collection($this->connection->get('plan', $parameters));
    }

    /**
     * Get a specific plan.
     *
     * @param string $handle
     * @return Plan
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $handle)
    {
        return new Plan($this->connection->get('plan/' . $handle));
    }

    /**
     * Get a list of plan versions.
     *
     * @param string $handle
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function versions(string $handle)
    {
        return Plan::collection($this->connection->get('plan/' . $handle));
    }

    /**
     * Get a specific version.
     *
     * @param string $handle
     * @param int $version
     * @return Plan
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function version(string $handle, int $version)
    {
        return new Plan($this->connection->get('plan/' . $handle . '/' . $version));
    }

    /**
     * Undelete a plan.
     *
     * @param string $handle
     * @return Plan
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function undelete(string $handle)
    {
        return new Plan($this->connection->post('plan/' . $handle . '/undelete'));
    }


}
