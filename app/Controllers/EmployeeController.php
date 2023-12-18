<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\Delivery;
use App\Models\Expense;
use CodeIgniter\I18n\Time;

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

    public function showregisteradmin($employeeId){
        $admin = new Employee();
        $admin = $admin->find($employeeId);
        $data = [
            'employeeId' => $employeeId,
            'admin' => $admin
        ];
        return view('admin/tambahemp', $data);
    }

    public function showEmployee($employeeId)
    {
        $epl = new Employee();
        $admin = $epl->find($employeeId);
        $data = [
            'employeeId' => $employeeId,
            'epl' => $admin,
            'admin' => $epl->findAll(),
        ];
        return view('admin/employee', $data);
    }

    public function store($employeeId)
    {
        $validation =  \Config\Services::validation();

        $rules = [
            'epl_name' => 'required',
            'epl_jobtitle' => 'required',
            'epl_phonenumber' => 'required',
            'epl_gender' => 'required',
            'epl_salary' => 'required',
            'epl_age' => 'required',
            'epl_uname' => 'required|is_unique[employee.epl_uname]',
            'epl_password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $employeeModel = new Employee();

        if (!$this->validate($rules)) {
            $session = session();
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $employeeData = [
            'epl_name' => $this->request->getVar('epl_name'),
            'epl_jobtitle' => $this->request->getVar('epl_jobtitle'),
            'epl_phonenumber' => $this->request->getVar('epl_phonenumber'),
            'epl_gender' => $this->request->getVar('epl_gender'),
            'epl_salary' => $this->request->getVar('epl_salary'),
            'epl_age' => $this->request->getVar('epl_age'),
            'epl_workstatus' => 'Tidak bekerja',
            'epl_uname' => $this->request->getVar('epl_uname'),
            'epl_password' => $this->request->getVar('epl_password'),
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        $employeeModel->insert($employeeData);

        return redirect()->to('admin/employee/' . $employeeId);
    }

    public function showLaporan($employeeId)
    {
        $employeeModel = new Employee();
        $admin = $employeeModel->find($employeeId);

        $transactionModel = new Transaction();
        $expenseModel = new Expense();

        $maxTscIdResult = $transactionModel->selectMax('tsc_id')->first();
        $maxTscId = $maxTscIdResult['tsc_id'] ?? 0;


        $transactionRevenue = $transactionModel
            ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->selectSum('tsc_totalprice')
            ->first();

        $expense = $expenseModel
            ->where('exp_date >=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->selectSum('exp_totalexpense')
            ->first();

        $profit = $transactionRevenue['tsc_totalprice'] - $expense['exp_totalexpense'];

        $data = [
            'employeeId' => $employeeId,
            'admin' => $admin,
            'maxTscId' => $maxTscId,
            'transactionRevenue' => $transactionRevenue['tsc_totalprice'] ?? 0,
            'expense' => $expense['exp_totalexpense'] ?? 0,
            'profit' => $profit ?? 0,
        ];

        return view('admin/laporan', $data);
    }
}
