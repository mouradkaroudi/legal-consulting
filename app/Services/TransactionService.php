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
	 * 
	 * @param Illuminate\Database\Eloquent\Model $payer ( a person which pay (e.g benificiary) )
	 * @param Illuminate\Database\Eloquent\Model $payee (a person to whom money is paid (e.g office) )
	 */
	public static function pay( Model $payer, Model $payee, $amount, $status, $metadata = [] ) {

		$payerData = [
			'amount' => $amount,
			'type' => 'credit',
			'source' => Transaction::PAY_DUES,
			'status' => $status,
			'metadata' => json_encode($metadata)
		];

		$payeeData = [
			'amount' => $amount,
			'type' => 'debit',
			'source' => Transaction::RECEIVE_EARNINGS,
			'status' => $status,
			'metadata' => json_encode($metadata)
		];

		$payer->transactions()->create($payerData);
		$payee->transactions()->create($payeeData);

		$payer->substractFromBalance($amount);
		$payee->addToBalance($amount);

	}

	/**
	 * Make a deposit
	 */
	public static function deposit( Model $holder, $amount, $status, $metadata = [] ): void {

		$data = [
			"amount" => $amount,
			"type" => "debit",
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

		if($this->txn->source !== Transaction::WITHDRAWALS) {
			if($this->txn->isDebit()) {
				$this->txn->transactionable->addToBalance($this->txn->amount);
			}else{
				$this->txn->transactionable->substractFromBalance($this->txn->amount);
			}
		}

		TransactionEvents\Accepted::dispatch($this->txn);
	}

	/**
	 * Refuse a pending transaction
	 */
	public function refuseTransaction( ?string $body = '' ) {
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
	public static function withdraw( $holder, $amount, $metadata = [] ) {

		$holder->transactions()->create([
			"amount" => $amount,
			"type" => "credit",
			"source" => Transaction::WITHDRAWALS,
			"status" => Transaction::PENDING,
			"metadata" => json_encode($metadata),
		]);

		$holder->substractFromBalance($amount);

	}

}
