<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\{Card, Model, MpsSubscription, PaymentMethod};

class CustomerPaymentMethodResource extends Resource
{
    public function all(string $handle)
    {
        return PaymentMethod::collection($this->connection->get('customer/' . $handle . '/payment_method'), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }

    public function deactivate(string $handle, string $card_id)
    {
        return PaymentMethod::collection($this->connection->post('customer/' . $handle . '/payment_method/' . $card_id . '/inactivate'), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }

    public function activate(string $handle, string $card_id)
    {
        return PaymentMethod::collection($this->connection->post('customer/' . $handle . '/payment_method/' . $card_id . '/activate'), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }

    public function delete(string $handle, string $card_id)
    {
        return PaymentMethod::collection($this->connection->delete('customer/' . $handle . '/payment_method/' . $card_id), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }

    public function reactivate(string $handle, string $card_id)
    {
        return PaymentMethod::collection($this->connection->post('customer/' . $handle . '/payment_method/' . $card_id), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }

    public function reactivate(string $handle, string $card_id)
    {
        return PaymentMethod::collection($this->connection->post('customer/' . $handle . '/payment_method/' . $card_id), false, [
            'cards' => Card::class,
            'mps_subscriptions' => MpsSubscription::class,
        ]);
    }
}
