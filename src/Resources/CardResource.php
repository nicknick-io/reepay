<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\PaymentMethod;

class CardResource extends Resource
{
    /**
     * @param string $id
     * @return PaymentMethod
     * @throws \NickNickIO\Reepay\Exceptions\ReepayException
     */
    public function verification(string $id)
    {
        return new PaymentMethod($this->connection->post('payment_method/' . $id . '/card/verify'));
    }
}
