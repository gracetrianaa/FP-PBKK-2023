<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;


class CustomerController extends BaseController
{
    public function showHome($customerId)
    {
        return view('homecust', ['customerId' => $customerId]);
    }

    public function showAbout($customerId)
    {
        return view('about', ['customerId' => $customerId]);
    }

    public function showProfileCust($customerId)
    {
        $user = (new Customer())->find($customerId);
        return view('profilecust', ['customerId' => $customerId, 'user' => $user]);
    }

    public function showOrderHistory($customerId)
    {
        $customer = (new Customer())->find($customerId);
        $transactions = (new Transaction())
            ->whereHas('customer', function ($query) use ($customer) {
                $query->where('customer_cst_id', $customer->cst_id);
            })
            ->get();

        return view('custorderhistory', ['customerId' => $customerId, 'transactions' => $transactions]);
    }

    public function showLogoutCust($customerId)
    {
        return view('logoutcust', ['customerId' => $customerId]);
    }

    public function showContact($customerId)
    {
        return view('contact', ['customerId' => $customerId]);
    }

    public function show()
    {
        return view('register');
    }

    public function store()
    {
        $validationRules = [
            'full_name' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'cst_uname' => 'required|is_unique[customer.cst_uname]',
            'cst_password' => 'required|min_length[6]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator);
        }

        $customerModel = new Customer();
        $maxId = $customerModel->selectMax('cst_id')->first();
        $newId = ($maxId ? $maxId['cst_id'] : 0) + 1;

        $data = [
            'cst_id' => $newId,
            'cst_name' => $this->request->getPost('full_name'),
            'cst_age' => $this->request->getPost('age'),
            'cst_address' => $this->request->getPost('address'),
            'cst_phonenumber' => $this->request->getPost('phone_number'),
            'cst_gender' => $this->request->getPost('gender'),
            'cst_uname' => $this->request->getPost('cst_uname'),
            'cst_password' => $this->request->getPost('cst_password'),
        ];

        $customerModel->insert($data);

        return redirect()->route('customer.showlogin');
    }


    public function showlogin(){
        return view('logincust');
    }

    public function login() {
        $request = \Config\Services::request();
        $username = $request->getPost('username');
        $password = $request->getPost('password');
        
        $customerModel = new Customer();
        $employeeModel = new Employee();
        
        $customer = $customerModel->where('cst_uname', $username)->first();
        $employee = $employeeModel->where('epl_uname', $username)->first();
        
        if ($customer && $customer['cst_password'] === $password) {
            // Perform login for customer
            return redirect()->to(route_to('customer.home', $customer['cst_id']));
        } elseif ($employee && $employee['epl_password'] === $password) {
            // Perform login for employee
            return redirect()->to(route_to('admin.dashboard', $employee['epl_id']));
        } else {
            return redirect()->back()->with('login_error', 'Invalid username or password.');
        }
    }


}
