<?php
namespace App\Services;

use App\Models\Order;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;
use Carbon\Carbon;

class SubscriptionService
{
	/**
	 * Create subscription or update exsiting subscription
	 */
	public static function createSubscription( $subscriber, ProfessionSubscriptionPlan $professionSubscriptionPlan)
	{
		$plan_type = $professionSubscriptionPlan->type;
		$started_at = Carbon::now();
		$expire_at = null;

		if($plan_type === ProfessionSubscriptionPlan::MONTHLY) {
			$expire_at = $started_at->addMonth();
		}

		if($plan_type === ProfessionSubscriptionPlan::YEARLY) {
			$expire_at = $started_at->addYear();
		}
		
		$subscriber->subscription()->create([
			'started_at' => $started_at,
			'expire_at' => $expire_at
		]);
	}

}
