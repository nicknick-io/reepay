<?php
namespace NickNickIO\Reepay;

use NickNickIO\Reepay\Resources\{AccountResource, OrganisationResource, PlanResource};

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
     * Reepay constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $connection = new Connection($token);

        $this->plan = new PlanResource($connection);
        $this->account = new AccountResource($connection);
        $this->organisation = new OrganisationResource($connection);
    }

}
