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
	 * 
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
            'metadata' => json_encode($metadata)
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
			'metadata' => json_encode($metadata)
		];

		$payeeData = [
			'amount' => $amount,
			'fees' => $payeeAmountFees,
			'actual_amount' => $payeeAmount,
			'type' => 'debit',
			'source' => Transaction::RECEIVE_EARNINGS,
			'status' => $status,
			'metadata' => json_encode($metadata)
		];

		$payer->transactions()->create($payerData);
		$payer->substractFromBalance($amount);

		$payee->transactions()->create($payeeData);
		$payee->addToBalance($payeeAmount);
	}

	/**
	 * Make a deposit
	 */
	public static function deposit(Model $holder, $amount, $status, $metadata = []): void
	{

		$data = [
			"amount" => $amount,
			"type" => "debit",
			"fees" => 0,
			"actual_amount" => $amount,
			"source" => Transaction::DEPOSIT,
			"status" => $status,
			"metadata" => json_encode($metadata)
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

		$holder->transactions()->create([
			"amount" => $amount,
			"fees" => 0,
			"actual_amount" => $amount,
			"type" => "credit",
			"source" => Transaction::WITHDRAWALS,
			"status" => Transaction::PENDING,
			"metadata" => json_encode($metadata),
		]);

		$holder->substractFromBalance($amount);
	}
}
