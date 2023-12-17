<?php

namespace App\Controllers;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Employee;
use App\Models\TransactionDetail;
use App\Models\Delivery;
use App\Models\EmployeeTransaction;
use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class TransactionController extends BaseController
{
    public function showorderform($customerId)
    {
        $serviceModel = new Service();
        $services = $serviceModel->select('svc_id, svc_name')->findAll();

        $formattedServices = [];
        foreach ($services as $service) {
            $formattedServices[$service['svc_id']] = $service['svc_name'];
        }
        return view('transactionform', ['customerId' => $customerId, 'services' => $formattedServices]);
    }

    public function processOrderForm($customerId)
    {
        $customer = new Customer();
        $transaction = new Transaction();
        $employee = new Employee();
        $transactionDetail = new TransactionDetail();
        $service = new Service();
        $delivery = new Delivery();
        $employee_transaction = new EmployeeTransaction();

        $customerExists = $customer->find($customerId);
        
        if ($customerExists) {  
            $newtscId = $transaction->selectMax('tsc_id')->first()['tsc_id'] + 1;
            $tglSelesai = date('Y-m-d H:i:s', strtotime('+3 days'));
            $maxeplId = $employee->selectMax('epl_id')->first()['epl_id'];;

            $transaction->insert([
                // 'tsc_id' => $newtscId + $transaction->where('tsc_id >=', $newtscId)->countAllResults(),
                'tsc_status' => 'New',
                'tsc_tglmasuk' => date('Y-m-d H:i:s'),
                'tsc_tglselesai' => $tglSelesai,
                'tsc_tglambil' => null,
                'tsc_totalprice' => 0,
                'customer_cst_id' => $customerId,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]);

            $employee_transaction->insert([
                'epl_id' => rand(1, $maxeplId),
                'tsc_id' => $newtscId
            ]);

            $validator = service('validation');
            $validator->setRules([
                'addmore.*.service' => 'required',
                'addmore.*.qty' => 'required|numeric',
            ]);

            if (!$validator->run($this->request->getPost())) {
                // Handle validation errors
                $errors = $validator->getErrors();
                die(var_dump($errors));
            }

            $totalPrice = 0;
            $tsc_detail = $this->request->getPost('addmore');
            foreach ($tsc_detail as $detail) {
                // Debugging
                var_dump($detail['service']);
            
                // $newId = $transactionDetail->selectMax('tsc_td_id') + 1;
                $selectedServiceName = $detail['service'];
                $service = $service->where('svc_name', $selectedServiceName)->first();
            
                if ($service) {
                    $service_svc_id = $service['svc_id'];
                    $svc_priceperkilo = $service['svc_priceperkilo'];
                }

                $totaltd = $svc_priceperkilo * $detail['qty'];
                $transactionDetail->insert([
                    // 'tsc_td_id' => $newId + $transactionDetail->where('tsc_td_id >=', $newId)->countAllResults(),
                    'tsc_td_quantity' => $detail['qty'],
                    'tsc_td_pricequantity' => 0,
                    'service_svc_id' => $service_svc_id,
                    'transaction_tsc_id' => $newtscId,
                ]);

                $totalPrice += $totaltd;
            }

            $customer = $customer->find($customerId);
            $deliveryNeeded = $this->request->getPost('delivery') === 'yes';
            $address = $this->request->getPost('address') ?? $customer['cst_address'];

            $deliveryprice = 0;
            if ($deliveryNeeded) {
                $randomNumber = mt_rand(10000, 30000);
                $deliveryprice = round($randomNumber, -3);

                // $newId = ($delivery->selectMax('div_id') ?? 0) + 1;
                $timestamp = strtotime('+3 days');
                $dateAhead = date('Y-m-d', $timestamp);

                $delivery->insert([
                    // 'div_id' => $newId,
                    'transaction_tsc_id' => $newtscId,
                    'div_address' => $address,
                    'div_date' => $dateAhead,
                    'div_price' => 0,
                    'employee_epl_id' => rand(1, $maxeplId),
                ]);
            }

            $totalPrice += $deliveryprice;

            $tscModel = $transaction->find($newtscId);
            $transaction->update($newtscId, ['tsc_totalprice' => $totalPrice]);


            return redirect()->to('customer/payment/information/total/'. $customerId);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
        }
    }
}
