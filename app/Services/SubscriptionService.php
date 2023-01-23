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

	public static function isEnabled()
	{
		return get_option('subscriptions_enable_subscription') == 1;
	}

	/**
	 * Return true if subscription expiring in next 3 days
	 * 
	 * @param $subscription
	 * @param int $days
	 * 
	 * @return bool
	 */
	public static function isSubscriptionExpireAfter(Subscription $subscription, int $days)
	{
		if ($subscription->expire_at == null) {
			return false;
		}

		return $subscription->expire_at <= Carbon::now()->addDays($days);
	}

	/**
	 * Create subscription or update exsiting subscription
	 */
	public static function createSubscription($subscriber, ProfessionSubscriptionPlan $professionSubscriptionPlan)
	{
		$plan_type = $professionSubscriptionPlan->type;
		$started_at = Carbon::now();
		$expire_at = null;

		if ($plan_type === ProfessionSubscriptionPlan::MONTHLY) {
			$expire_at = $started_at->addMonth();
		}

		if ($plan_type === ProfessionSubscriptionPlan::YEARLY) {
			$expire_at = $started_at->addYear();
		}

		$subscriber->subscription()->create([
			'plan_id' => $professionSubscriptionPlan->id,
			'started_at' => $started_at,
			'expire_at' => $expire_at
		]);
	}
}
