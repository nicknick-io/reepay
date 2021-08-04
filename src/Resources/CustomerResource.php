<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Connection;
use NickNickIO\Reepay\Exceptions\ReepayException;
use NickNickIO\Reepay\Models\Customer;

class CustomerResource extends Resource
{

    /**
     * @var CustomerNoteResource
     */
    public CustomerNoteResource $note;

    /**
     * CustomerResource constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
        $this->note = new CustomerNoteResource($connection);
    }

    /**
     * @param array $parameters
     * @return array|object
     * @throws ReepayException
     */
    public function all(array $parameters = [])
    {
        return Customer::collection($this->connection->get('customer', $parameters), true);
    }

    /**
     * @param string $handle
     * @return Customer
     * @throws ReepayException
     */
    public function get(string $handle)
    {
        return new Customer($this->connection->get('customer/' . $handle));
    }
}
