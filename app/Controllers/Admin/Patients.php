<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\DoctorModel;

class Patients extends BaseController
{
    protected $patientModel;
    protected $doctorModel;
    
    public function __construct()
    {
        $this->patientModel = new PatientModel();
        $this->doctorModel = new DoctorModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Patient Management - Mithlesh Nursing Home',
            'patients' => $this->patientModel->getPatientsWithDoctors()
        ];
        
        return view('admin/patients/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Add Patient - Mithlesh Nursing Home',
            'doctors' => $this->doctorModel->getActiveDoctors(),
            'patientId' => $this->patientModel->generatePatientId()
        ];
        
        return view('admin/patients/create', $data);
    }
    
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|max_length[20]',
            'gender' => 'required|in_list[Male,Female,Other]',
            'age' => 'required|integer|greater_than[0]|less_than[150]',
            'address' => 'required',
            'patient_type' => 'required|in_list[IPD,OPD]',
            'disease' => 'required|max_length[200]',
            'doctor_id' => 'required|integer',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'gender' => $this->request->getPost('gender'),
            'age' => $this->request->getPost('age'),
            'address' => $this->request->getPost('address'),
            'patient_type' => $this->request->getPost('patient_type'),
            'admission_date' => $this->request->getPost('admission_date'),
            'disease' => $this->request->getPost('disease'),
            'diagnosis' => $this->request->getPost('diagnosis'),
            'doctor_id' => $this->request->getPost('doctor_id'),
            'room_number' => $this->request->getPost('room_number'),
            'bed_number' => $this->request->getPost('bed_number'),
            'status' => $this->request->getPost('status') ?? 'Admitted',
        ];
        
        $this->patientModel->insert($data);
        
        return redirect()->to('admin/patients')
                        ->with('success', 'Patient added successfully.');
    }
    
    public function edit($id)
    {
        $patient = $this->patientModel->find($id);
        
        if (!$patient) {
            return redirect()->to('admin/patients')
                            ->with('error', 'Patient not found.');
        }
        
        $data = [
            'title' => 'Edit Patient - Mithlesh Nursing Home',
            'patient' => $patient,
            'doctors' => $this->doctorModel->getActiveDoctors()
        ];
        
        return view('admin/patients/edit', $data);
    }
    
    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|max_length[20]',
            'gender' => 'required|in_list[Male,Female,Other]',
            'age' => 'required|integer|greater_than[0]|less_than[150]',
            'address' => 'required',
            'patient_type' => 'required|in_list[IPD,OPD]',
            'disease' => 'required|max_length[200]',
            'doctor_id' => 'required|integer',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'gender' => $this->request->getPost('gender'),
            'age' => $this->request->getPost('age'),
            'address' => $this->request->getPost('address'),
            'patient_type' => $this->request->getPost('patient_type'),
            'admission_date' => $this->request->getPost('admission_date'),
            'discharge_date' => $this->request->getPost('discharge_date'),
            'disease' => $this->request->getPost('disease'),
            'diagnosis' => $this->request->getPost('diagnosis'),
            'doctor_id' => $this->request->getPost('doctor_id'),
            'room_number' => $this->request->getPost('room_number'),
            'bed_number' => $this->request->getPost('bed_number'),
            'bill_amount' => $this->request->getPost('bill_amount'),
            'status' => $this->request->getPost('status'),
        ];
        
        $this->patientModel->update($id, $data);
        
        return redirect()->to('admin/patients')
                        ->with('success', 'Patient updated successfully.');
    }
    
    public function delete($id)
    {
        $patient = $this->patientModel->find($id);
        
        if (!$patient) {
            return redirect()->to('admin/patients')
                            ->with('error', 'Patient not found.');
        }
        
        $this->patientModel->delete($id);
        
        return redirect()->to('admin/patients')
                        ->with('success', 'Patient deleted successfully.');
    }
    
    public function view($id)
    {
        $patient = $this->patientModel->select('patients.*, doctors.name as doctor_name')
                                       ->join('doctors', 'doctors.id = patients.doctor_id')
                                       ->where('patients.id', $id)
                                       ->first();
        
        if (!$patient) {
            return redirect()->to('admin/patients')
                            ->with('error', 'Patient not found.');
        }
        
        $data = [
            'title' => 'View Patient - Mithlesh Nursing Home',
            'patient' => $patient
        ];
        
        return view('admin/patients/view', $data);
    }
}
