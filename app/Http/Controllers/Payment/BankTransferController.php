<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class BankTransferController extends Controller
{

    public function subscription(Request $request)
    {

        return view('pages.payment.bank-transfer');

    }
}
