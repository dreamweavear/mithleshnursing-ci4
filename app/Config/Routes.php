<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('services', 'Home::services');
$routes->get('camps', 'Home::camps');
$routes->get('doctors', 'Home::doctors');
$routes->get('contact', 'Home::contact');
$routes->post('submit-inquiry', 'Home::submitInquiry');

// Admin Auth Routes (No filter needed)
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/authenticate', 'Admin\Auth::authenticate');
$routes->get('admin/logout', 'Admin\Auth::logout');

// Admin Routes (Protected by Auth Filter)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Patients
    $routes->get('patients', 'Admin\Patients::index');
    $routes->get('patients/create', 'Admin\Patients::create');
    $routes->post('patients/store', 'Admin\Patients::store');
    $routes->get('patients/search', 'Admin\Patients::search');
    $routes->get('patients/edit/(:num)', 'Admin\Patients::edit/$1');
    $routes->post('patients/update/(:num)', 'Admin\Patients::update/$1');
    $routes->get('patients/delete/(:num)', 'Admin\Patients::delete/$1');
    $routes->get('patients/view/(:num)', 'Admin\Patients::view/$1');
    $routes->get('patients/convert-to-ipd/(:num)', 'Admin\Patients::convertToIpd/$1');
    $routes->post('patients/convert-to-ipd/(:num)', 'Admin\Patients::convertToIpd/$1');
    
    // Staff
    $routes->get('staff', 'Admin\Staff::index');
    $routes->get('staff/create', 'Admin\Staff::create');
    $routes->post('staff/store', 'Admin\Staff::store');
    $routes->get('staff/edit/(:num)', 'Admin\Staff::edit/$1');
    $routes->post('staff/update/(:num)', 'Admin\Staff::update/$1');
    $routes->get('staff/delete/(:num)', 'Admin\Staff::delete/$1');
    
    // Doctors
    $routes->get('doctors', 'Admin\Doctors::index');
    $routes->get('doctors/create', 'Admin\Doctors::create');
    $routes->post('doctors/store', 'Admin\Doctors::store');
    $routes->get('doctors/edit/(:num)', 'Admin\Doctors::edit/$1');
    $routes->post('doctors/update/(:num)', 'Admin\Doctors::update/$1');
    $routes->get('doctors/delete/(:num)', 'Admin\Doctors::delete/$1');
    
    // Appointments
    $routes->get('appointments', 'Admin\Appointments::index');
    $routes->get('appointments/today', 'Admin\Appointments::today');
    $routes->get('appointments/create', 'Admin\Appointments::create');
    $routes->post('appointments/store', 'Admin\Appointments::store');
    $routes->get('appointments/view/(:num)', 'Admin\Appointments::view/$1');
    $routes->get('appointments/edit/(:num)', 'Admin\Appointments::edit/$1');
    $routes->post('appointments/update/(:num)', 'Admin\Appointments::update/$1');
    $routes->get('appointments/delete/(:num)', 'Admin\Appointments::delete/$1');
    $routes->post('appointments/update-status/(:num)', 'Admin\Appointments::updateStatus/$1');
    $routes->post('appointments/prescription/(:num)', 'Admin\Appointments::savePrescription/$1');
    $routes->get('appointments/print-prescription/(:num)', 'Admin\Appointments::printPrescription/$1');
    
    // Inquiries
    $routes->get('inquiries', 'Admin\Inquiries::index');
    $routes->get('inquiries/view/(:num)', 'Admin\Inquiries::view/$1');
    $routes->post('inquiries/update-status/(:num)', 'Admin\Inquiries::updateStatus/$1');
    $routes->get('inquiries/delete/(:num)', 'Admin\Inquiries::delete/$1');
    
    // Profile / Password Change
    $routes->get('profile', 'Admin\Auth::profile');
    $routes->post('profile/change-password', 'Admin\Auth::changePassword');

    // Bills
    $routes->get('bills', 'Admin\Bills::index');
    $routes->get('bills/create', 'Admin\Bills::create');
    $routes->post('bills/store', 'Admin\Bills::store');
    $routes->get('bills/view/(:num)', 'Admin\Bills::view/$1');
    $routes->get('bills/edit/(:num)', 'Admin\Bills::edit/$1');
    $routes->post('bills/update/(:num)', 'Admin\Bills::update/$1');
    $routes->get('bills/print/(:num)', 'Admin\Bills::print/$1');
    $routes->get('bills/pdf/(:num)', 'Admin\Bills::downloadPdf/$1');
    $routes->post('bills/update-payment/(:num)', 'Admin\Bills::updatePayment/$1');
    $routes->get('bills/delete/(:num)', 'Admin\Bills::delete/$1');
});

// Default redirect
$routes->get('admin', function() {
    return redirect()->to('admin/dashboard');
});
