<?php
namespace App\Services;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderPaidNotification;

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
			"status" => Order::UNPAID,
		]);

		if ($order) {
			Notification::send(
				User::find($user_id),
				new OrderCreatedNotification($order)
			);
		}
	}


	public static function orderPaid($order) {
		$order->status = Order::PAID;
		$order->save();

		Notification::send(
			$order->office->employees()->permission('manage-orders')->get(),
			new OrderPaidNotification($order)
		);

		// send notification to the office owner
		Notification::send(
			DigitalOfficeEmployee::where('user_id', $order->office->user_id)->get(),
			new OrderPaidNotification($order)
		);


	}

}
