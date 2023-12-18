<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\Delivery;
use App\Models\Service;
use App\Models\Expense;
use App\Models\ExpenseEmployee;
use CodeIgniter\I18n\Time;

class ExpenseController extends BaseController
{
    public function showExpense($employeeId)
    {
        $employeeModel = new Employee();
        $admin = $employeeModel->find($employeeId);

        return view('admin/tambahexp', [
            'employeeId' => $employeeId,
            'admin' => $admin,
        ]);
    }

    public function store($employeeId)
    {
        helper(['form', 'url']);

        $rules = [
            'exp_type' => 'required',
            'exp_totalexpense' => 'required',
            'exp_date' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator);
        }

        $expenseModel = new Expense();
        $data = [
            'exp_type' => $this->request->getVar('exp_type'),
            'exp_totalexpense' => $this->request->getVar('exp_totalexpense'),
            'exp_date' => $this->request->getVar('exp_date'),
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        try {
            $expense = $expenseModel->insert($data);

            $lastInsertId = $expenseModel->getInsertID();

            $expenseEmployeeModel = new ExpenseEmployee();
            $expenseEmployeeModel->insert([
                'exp_id' => $lastInsertId,
                'epl_id' => $employeeId,
            ]);

            return redirect()->to('admin/expense/list/' . $employeeId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showExpenseList($employeeId)
    {
        $employeeModel = new Employee();
        
        // Fetch the admin details
        $admin = $employeeModel->find($employeeId);

        // Fetch expenses using Model's query builder
        $expenseModel = new Expense();
        $expenses = $expenseModel
            ->select('expense.*')
            ->join('expense_employee', 'expense.exp_id = expense_employee.exp_id')
            ->join('employee', 'expense_employee.epl_id = employee.epl_id')
            ->where('employee.epl_id', $employeeId)
            ->findAll();

        $data = [
            'employeeId' => $employeeId,
            'admin' => $admin,
            'expenses' => $expenses,
        ];
    
        return view('admin/expense', $data);
    }
}
