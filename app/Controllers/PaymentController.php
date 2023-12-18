<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Transaction;
use App\Models\Payment;
use CodeIgniter\I18n\Time;

class PaymentController extends BaseController
{
    public function showPaymentTotal($customerId){
        return view('paymenttotal', ['customerId' => $customerId]);
    }

    public function showPaymentForm($customerId){
        return view('paymentform', ['customerId' => $customerId]);
    }

    public function processPaymentForm($customerId)
    {
        $transactionModel = new Transaction();
        $paymentModel = new Payment();

        $transaction = $transactionModel->where('customer_cst_id', $customerId)->orderBy('created_at', 'DESC')->first();

        $discount = 0;
        if ($transaction['tsc_totalprice'] >= 150000) {
            $discount = $transaction['tsc_totalprice'] * 0.1;
        }

        $pmmethod = $this->request->getPost('pm_method');

        $paymentData = [
            'pm_method' => $pmmethod,
            'pm_date' => Time::now(),
            'pm_amount' => $transaction['tsc_totalprice'],
            'pm_discount' => $discount,
            'transaction_tsc_id' => $transaction['tsc_id'],
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        $paymentModel->insert($paymentData);

        return redirect()->to('customer/home/orderhistory/' . $customerId);
    }

}
