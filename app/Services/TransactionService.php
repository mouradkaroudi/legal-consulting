<?php

namespace App\Services;

use App\Models\Transaction;
use App\Events\Transaction as TransactionEvents;
use App\Models\DigitalOffice;
use App\Models\User;

class TransactionService
{
	public $txn = null;

	public function __construct(Transaction $txn)
	{
		$this->txn = $txn;
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
