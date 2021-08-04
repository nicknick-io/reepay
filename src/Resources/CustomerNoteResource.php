<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Exceptions\ReepayException;
use NickNickIO\Reepay\Models\CustomerNote;

class CustomerNoteResource extends Resource
{
    /**
     * @param string $customer_handle
     * @return array|object
     * @throws ReepayException
     */
    public function all(string $customer_handle)
    {
        return CustomerNote::collection($this->connection->get('customer/' . $customer_handle . '/note'));
    }
}
