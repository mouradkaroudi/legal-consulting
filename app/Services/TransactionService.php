<?php

namespace App\Services;

use App\Models\Transaction;
use App\Events\Transaction as TransactionEvents;
use Illuminate\Database\Eloquent\Model;

class TransactionService
{
	public $txn = null;

	public function __construct(Transaction $txn)
	{
		$this->txn = $txn;
	}

	/**
	 * FIXME: move this to Subscription service
	 */
	public static function subscribe(Model $payer, $amount, $status, $metadata = [])
	{
		$payer->transactions()->create([
			'amount' => $amount,
			'fees' => 0,
			'actual_amount' => $amount,
			'type' => 'credit',
			'source' => Transaction::SUBSCRIPTION_FEES,
			'status' => $status,
			'metadata' => $metadata
		]);

		$payer->substractFromBalance($amount);
	}

	/**
	 * 
	 * 
	 * @param Illuminate\Database\Eloquent\Model $payer ( a person which pay (e.g benificiary) )
	 * @param Illuminate\Database\Eloquent\Model $payee (a person to whom money is paid (e.g office) )
	 */
	public static function pay(Model $payer, Model $payee, $amount, $status, $metadata = [])
	{
		// FIXME: consider moving fee calculation to where we call this method
		$professionFees = $payee->profession->fee_percentage;
		$payeeAmount = $amount;
		$payeeAmountFees = 0;

		if (!empty($professionFees) && $professionFees > 0) {
			$payeeAmountFees = ($payeeAmount * ($professionFees / 100));
			$payeeAmount = $payeeAmount - $payeeAmountFees;
		}

		$payerData = [
			'amount' => $amount,
			'fees' => 0,
			'actual_amount' => $amount,
			'type' => 'credit',
			'source' => Transaction::PAY_DUES,
			'status' => $status,
			'metadata' => $metadata
		];

		$payeeData = [
			'amount' => $amount,
			'fees' => $payeeAmountFees,
			'actual_amount' => $payeeAmount,
			'type' => 'debit',
			'source' => Transaction::RECEIVE_EARNINGS,
			'status' => $status,
			'metadata' => $metadata
		];

		$payer->transactions()->create($payerData);
		$payer->substractFromBalance($amount);

		$payee->transactions()->create($payeeData);
		$payee->addToBalance($payeeAmount);
	}

	/**
	 * Make a deposit
	 */
	public static function deposit(Model $holder, $args): void
	{	

		$amount = $args['amount'];
		$fees = $args['fees'] ?? 0;
		$status = $args['status'];
		$metadata = $args['metadata'] ?? [];

		$data = [
			"amount" => $amount,
			"type" => "debit",
			"fees" => $fees,
			"actual_amount" => $amount,
			"source" => Transaction::DEPOSIT,
			"status" => $status,
			"metadata" => $metadata
		];

		$holder->transactions()->create($data);

		$holder->addToBalance($amount);
	}

	/**
	 * Accept a pending transaction
	 */
	public function AccpetTransaction()
	{
		if ($this->txn->status !== Transaction::PENDING) {
			return;
		}

		$this->txn->completeTransaction();

		if ($this->txn->source !== Transaction::WITHDRAWALS) {
			if ($this->txn->isDebit()) {
				$this->txn->transactionable->addToBalance($this->txn->amount);
			} else {
				$this->txn->transactionable->substractFromBalance($this->txn->amount);
			}
		}

		TransactionEvents\Accepted::dispatch($this->txn);
	}

	/**
	 * Refuse a pending transaction
	 */
	public function refuseTransaction(?string $body = '')
	{
		if ($this->txn->status !== Transaction::PENDING) {
			return;
		}

		$this->txn->status = Transaction::FAILED;
		$this->txn->save();

		TransactionEvents\Refused::dispatch($this->txn, $body);
	}

	/**
	 * 
	 */
	public static function withdraw($holder, $amount, $metadata = [])
	{

		if ($holder->available_balance < $amount) {
			throw new \Exception(__('Insufficient account credit'));
		}

		$holder->transactions()->create([
			"amount" => $amount,
			"fees" => 0,
			"actual_amount" => $amount,
			"type" => "credit",
			"source" => Transaction::WITHDRAWALS,
			"status" => Transaction::PENDING,
			"metadata" => $metadata,
		]);

		$holder->substractFromBalance($amount);
	}
}
