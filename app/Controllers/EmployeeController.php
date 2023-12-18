<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\Delivery;

class EmployeeController extends BaseController
{
    public function showDashboard($employeeId)
    {
        $employeeModel = new Employee();
        $admin = $employeeModel->find($employeeId);

        $transactionModel = new Transaction();
        $transactions = $transactionModel
            ->select('transaction.*')
            ->join('employee_transaction', 'transaction.tsc_id = employee_transaction.tsc_id')
            ->join('employee', 'employee_transaction.epl_id = employee.epl_id')
            ->where('employee.epl_id', $employeeId)
            ->findAll();


        $deliveryModel = new Delivery();
        $deliveries = $deliveryModel
            ->select('*')
            ->where('employee_epl_id', $employeeId)
            ->findAll();

        return view('admin/dashboard', ['employeeId' => $employeeId, 'admin' => $admin, 'transactions' => $transactions, 'deliveries' => $deliveries]);
    }

}
