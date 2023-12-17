<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login
$routes->get('/', 'CustomerController::showlogin', ['as' => 'customer.showlogin']);
$routes->post('/', 'CustomerController::login', ['as' => 'customer.login']);


$routes->group('customer', function ($routes){
    $routes->get('register', 'CustomerController::show');
    $routes->post('register', 'CustomerController::store', ['as' => 'customer.store']);

    $routes->get('home/(:num)', 'CustomerController::showhome/$1', ['as' => 'customer.home']);
    $routes->get('home/about/(:num)', 'CustomerController::showabout/$1', ['as' => 'customer.about']);
    $routes->get('home/orderhistory/(:num)', 'CustomerController::showorderhistory/$1', ['as' => 'customer.orderhistory']);
    $routes->get('home/profilecust/(:num)', 'CustomerController::showprofilecust/$1', ['as' => 'customer.profilecust']);
    $routes->get('home/logoutcut/(:num)', 'CustomerController::showlogoutcust/$1', ['as' => 'customer.logout']);
    $routes->get('home/contact/(:num)', 'CustomerController::showcontact/$1', ['as' => 'customer.contact']);
});

$routes->group('admin', function ($routes) {
    // Home Dashboard Admin
    $routes->get('dashboard/(:num)', 'EmployeeController::showDashboard/$1', ['as' => 'admin.dashboard']);
    
    // Profile Admin
    $routes->get('profile/(:num)', 'EmployeeController::showProfile/$1', ['as' => 'admin.profile']);
    
    // Employee
    $routes->get('employee/dashboard/(:num)', 'EmployeeController::showEmployee/$1', ['as' => 'employee.dashboard']);
    
    // Expense
    $routes->get('expense/(:num)', 'ExpenseController::showExpense/$1', ['as' => 'admin.expense']);
    $routes->post('expense/(:num)', 'ExpenseController::store/$1', ['as' => 'expense.store']);
    $routes->get('expense/list/(:num)', 'ExpenseController::showExpenseList/$1', ['as' => 'expense.list']);
    
    // Service
    $routes->get('service/(:num)', 'ServiceController::showService/$1', ['as' => 'admin.service']);
    $routes->get('service/tambah/(:num)', 'ServiceController::showaddserviceform/$1', ['as' => 'service.showaddserviceform']);
    $routes->post('service/tambah/(:num)', 'ServiceController::store/$1', ['as' => 'service.store']);
    
    // Job Transaction
    $routes->get('jobtransaction/(:num)', 'EmployeeController::showJobTransaction/$1', ['as' => 'admin.jobtransaksi']);
    
    // Job Delivery
    $routes->get('jobdelivery/(:num)', 'EmployeeController::showJobDelivery/$1', ['as' => 'admin.jobdelivery']);
    
    // Employee
    $routes->get('employee/(:num)', 'EmployeeController::showEmployee/$1', ['as' => 'admin.employee']);
    
    // Laporan
    $routes->get('laporan/(:num)', 'EmployeeController::showLaporan/$1', ['as' => 'admin.laporan']);
    
    // Register employee
    $routes->get('register/(:num)', 'EmployeeController::showregisteradmin/$1', ['as' => 'admin.showregister']);
    $routes->post('register/(:num)', 'EmployeeController::store/$1', ['as' => 'admin.store']);
    
    // Transaction
    $routes->get('transaction/(:num)/orderform', 'TransactionController::showorderform/$1', ['as' => 'transaction.showorderform']);
    $routes->post('transaction/(:num)/orderform', 'TransactionController::processorderform/$1', ['as' => 'transaction.processorderform']);
    
    // Payment
    $routes->get('payment/(:num)/information/total', 'PaymentController::showPaymentTotal/$1', ['as' => 'payment.paymenttotal']);
    $routes->get('payment/(:num)/information', 'PaymentController::showpaymentform/$1', ['as' => 'payment.forminfo']);
    $routes->post('payment/(:num)/information', 'PaymentController::processPaymentForm/$1', ['as' => 'payment.processpaymentform']);
    
    $routes->get('expense/update-timestamps', 'TransactionController::updateTimestamps');
});


