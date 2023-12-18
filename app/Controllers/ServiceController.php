<?php

namespace App\Controllers;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\Delivery;
use App\Models\Service;
use CodeIgniter\I18n\Time;


use App\Controllers\BaseController;

class ServiceController extends BaseController
{
    public function showService($employeeId)
    {
        $employeeModel = new Employee();
        $admin = $employeeModel->find($employeeId);

        $serviceModel = new Service(); // Assuming ServiceModel is the model for the 'service' table
        $service = $serviceModel->findAll();

        return view('admin/service', ['employeeId' => $employeeId, 'admin' => $admin, 'service' => $service]);
    }

    public function showaddserviceform($employeeId)
    {
        $employeeModel = new Employee();
        $admin = $employeeModel->find($employeeId);

        return view('admin/addservice', ['employeeId' => $employeeId, 'admin' => $admin]);
    }

    public function store($employeeId)
    {
        $validationRules = [
            'svc_name' => 'required',
            'svc_priceperkilo' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $requestData = [
            'svc_name' => $this->request->getPost('svc_name'),
            'svc_priceperkilo' => $this->request->getPost('svc_priceperkilo'),
        ];

        try {
            $existingService = (new Service())->where('svc_name', $requestData['svc_name'])->first();

            if ($existingService) {
                return redirect()->back()->withInput()->with('errors', ['svc_name' => 'The service already exists. Please create a different service.']);
            }

            $serviceModel = new Service();
            $serviceModel->insert([
                'svc_name' => $requestData['svc_name'],
                'svc_priceperkilo' => $requestData['svc_priceperkilo'],
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]);

            return redirect()->to('admin/service/' . $employeeId);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
