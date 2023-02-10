<?php

namespace App\Services;

use App\Models\ProfessionSubscriptionPlan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SubscriptionService
{

	public static function isEnabled()
	{
		return setting('subscriptions_enable_subscription') == true;
	}

	/**
	 * Return true if subscription expiring in next 3 days
	 * 
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
	public static function createSubscription(Model $subscriber, ProfessionSubscriptionPlan $professionSubscriptionPlan)
	{
		$plan_type = $professionSubscriptionPlan->type;
		$started_at = Carbon::now();
		$expire_at = null;

		if ($plan_type == ProfessionSubscriptionPlan::MONTHLY) {
			$expire_at = $started_at->addMonth();
		}

		if ($plan_type == ProfessionSubscriptionPlan::YEARLY) {
			$expire_at = $started_at->addYear();
		}

		$subscriber->subscription()->create([
			'plan_id' => $professionSubscriptionPlan->id,
			'started_at' => $started_at,
			'expire_at' => $expire_at
		]);
	}
}
