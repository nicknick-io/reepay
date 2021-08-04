<?php
namespace NickNickIO\Reepay;

use NickNickIO\Reepay\Resources\{AccountResource, DunningPlanResource, OrganisationResource, PlanResource};

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
     * @var OrganisationResource
     */
    public OrganisationResource $organisation;

    /**
     * @var DunningPlanResource
     */
    public DunningPlanResource $dunning_plan;


    /**
     * Reepay constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $connection = new Connection($token);

        $this->plan = new PlanResource($connection);
        $this->account = new AccountResource($connection);
        $this->organisation = new OrganisationResource($connection);
        $this->dunning_plan = new DunningPlanResource($connection);
    }

}
