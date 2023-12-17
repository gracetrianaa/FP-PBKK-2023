<?php

namespace App\Controllers;

use App\Models\Service;
use App\Controllers\BaseController;

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

    
}
