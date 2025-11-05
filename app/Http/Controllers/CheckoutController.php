<?php

namespace App\Http\Controllers;

use App\Services\GatewayService;
use App\Services\TransactionService;

class CheckoutController extends Controller
{
    public function __construct(
        private GatewayService $gatewayService,
        private TransactionService $transactionService,
    ) {}
}
