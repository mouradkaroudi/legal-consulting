<?php
namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;

class OrderService
{
	/**
	 * Create new order
	 */
	public static function createOrder($subject, $user_id, $office_id, $subtotal)
	{
		$order = Order::create([
			"office_id" => $office_id,
			"beneficiary_id" => $user_id,
			"subject" => $subject,
			"fee" => $subtotal,
			"status" => "unpaid",
		]);

		if ($order) {
			Notification::send(
				User::find($user_id),
				new OrderCreatedNotification($order)
			);
		}
	}
}
