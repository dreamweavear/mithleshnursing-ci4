<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\StaffModel;
use App\Models\AppointmentModel;

class Dashboard extends BaseController
{
    protected $patientModel;
    protected $doctorModel;
    protected $staffModel;
    protected $appointmentModel;
    
    public function __construct()
    {
        $this->patientModel = new PatientModel();
        $this->doctorModel = new DoctorModel();
        $this->staffModel = new StaffModel();
        $this->appointmentModel = new AppointmentModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Dashboard - Mithlesh Nursing Home',
            'totalPatients' => $this->patientModel->getTotalPatientCount(),
            'activePatients' => $this->patientModel->getActivePatientCount(),
            'todayAdmissions' => $this->patientModel->getTodayAdmissions(),
            'totalDoctors' => $this->doctorModel->getDoctorCount(),
            'totalStaff' => $this->staffModel->getStaffCount(),
            'todayAppointments' => $this->appointmentModel->getTodayAppointmentCount(),
        ];
        
        return view('admin/dashboard/index', $data);
    }
}
