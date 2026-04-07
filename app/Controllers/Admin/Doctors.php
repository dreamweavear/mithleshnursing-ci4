<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DoctorModel;

class Doctors extends BaseController
{
    protected $doctorModel;
    
    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Doctor Management - Mithlesh Nursing Home',
            'doctors' => $this->doctorModel->findAll()
        ];
        
        return view('admin/doctors/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Add Doctor - Mithlesh Nursing Home'
        ];
        
        return view('admin/doctors/create', $data);
    }
    
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'specialization' => 'required|max_length[100]',
            'phone' => 'required|max_length[20]',
            'experience' => 'permit_empty|max_length[50]',
            'qualification' => 'permit_empty|max_length[200]',
            'availability_time' => 'permit_empty|max_length[200]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'specialization' => $this->request->getPost('specialization'),
            'experience' => $this->request->getPost('experience'),
            'qualification' => $this->request->getPost('qualification'),
            'availability_time' => $this->request->getPost('availability_time'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'status' => 'active',
        ];
        
        $this->doctorModel->insert($data);
        
        return redirect()->to('admin/doctors')
                        ->with('success', 'Doctor added successfully.');
    }
    
    public function edit($id)
    {
        $doctor = $this->doctorModel->find($id);
        
        if (!$doctor) {
            return redirect()->to('admin/doctors')
                            ->with('error', 'Doctor not found.');
        }
        
        $data = [
            'title' => 'Edit Doctor - Mithlesh Nursing Home',
            'doctor' => $doctor
        ];
        
        return view('admin/doctors/edit', $data);
    }
    
    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'specialization' => 'required|max_length[100]',
            'phone' => 'required|max_length[20]',
            'experience' => 'permit_empty|max_length[50]',
            'qualification' => 'permit_empty|max_length[200]',
            'availability_time' => 'permit_empty|max_length[200]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'specialization' => $this->request->getPost('specialization'),
            'experience' => $this->request->getPost('experience'),
            'qualification' => $this->request->getPost('qualification'),
            'availability_time' => $this->request->getPost('availability_time'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
        ];
        
        $this->doctorModel->update($id, $data);
        
        return redirect()->to('admin/doctors')
                        ->with('success', 'Doctor updated successfully.');
    }
    
    public function delete($id)
    {
        $doctor = $this->doctorModel->find($id);
        
        if (!$doctor) {
            return redirect()->to('admin/doctors')
                            ->with('error', 'Doctor not found.');
        }
        
        $this->doctorModel->delete($id);
        
        return redirect()->to('admin/doctors')
                        ->with('success', 'Doctor deleted successfully.');
    }
}
