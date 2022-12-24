<?php

namespace App\Services;

use App\Models\Transaction;
use App\Events\Transaction as TransactionEvents;
use App\Models\DigitalOffice;
use App\Models\User;

class TransactionService
{
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
		$this->txn->transactionable->addToCreditBalance($this->txn->amount);

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
	
}
