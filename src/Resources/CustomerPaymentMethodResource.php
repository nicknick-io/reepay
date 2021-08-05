<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\{
    Card, MpsSubscription, PaymentMethod
};

class CustomerPaymentMethodResource extends Resource
{
    public function all(string $handle)
    {
        return PaymentMethod::collection($this->connection->get('customer/' . $handle . '/payment_method'), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }
}
