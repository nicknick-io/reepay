<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Connection;
use NickNickIO\Reepay\Models\Account;

class AccountResource extends Resource
{
    /**
     * @var AccountPrivateKeyResource
     */
    public $private_key;

    /**
     * @var AccountPublicKeyResource
     */
    public $public_key;

    /**
     * @var AccountMailResource
     */
    public $mail;

    /**
     * @var AccountWebhookResource
     */
    public $webhook;

    /**
     * @var AccountDiscountResource
     */
    public $discount;

    /**
     * AccountResource constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
        $this->mail = new AccountMailResource($connection);
        $this->webhook = new AccountWebhookResource($connection);
        $this->discount = new AccountDiscountResource($connection);
        $this->public_key = new AccountPublicKeyResource($connection);
        $this->private_key = new AccountPrivateKeyResource($connection);
    }

    /**
     * @return Account
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get()
    {
        return new Account($this->connection->get('account'));
    }
}
