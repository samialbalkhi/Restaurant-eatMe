<?php
namespace App\Service\RestaurantOwner;

use App\Models\OrderItem;

class ShowItemsOrderService
{
    public function showItemsOrder($orderId)
    {
        $owner = auth('restaurantOwner')->user();

        $order = $owner->restaurantBranche->orders()->find($orderId)->orderItems;

        return $order;
    }
    public function showOneItemOrder(OrderItem $orderItem)
    {
        return $orderItem->find($orderItem->id);
    }
}
