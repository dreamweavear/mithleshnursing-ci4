<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StaffModel;

class Staff extends BaseController
{
    protected $staffModel;
    
    public function __construct()
    {
        $this->staffModel = new StaffModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Staff Management - Mithlesh Nursing Home',
            'staff' => $this->staffModel->findAll()
        ];
        
        return view('admin/staff/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Add Staff - Mithlesh Nursing Home'
        ];
        
        return view('admin/staff/create', $data);
    }
    
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[Doctor,Nurse,Receptionist,Lab Technician,Pharmacist]',
            'phone' => 'required|max_length[20]',
            'salary' => 'required|decimal',
            'joining_date' => 'required|valid_date',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'salary' => $this->request->getPost('salary'),
            'joining_date' => $this->request->getPost('joining_date'),
            'qualification' => $this->request->getPost('qualification'),
            'status' => 'Active',
        ];
        
        $this->staffModel->insert($data);
        
        return redirect()->to('admin/staff')
                        ->with('success', 'Staff member added successfully.');
    }
    
    public function edit($id)
    {
        $staff = $this->staffModel->find($id);
        
        if (!$staff) {
            return redirect()->to('admin/staff')
                            ->with('error', 'Staff member not found.');
        }
        
        $data = [
            'title' => 'Edit Staff - Mithlesh Nursing Home',
            'staff' => $staff
        ];
        
        return view('admin/staff/edit', $data);
    }
    
    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[Doctor,Nurse,Receptionist,Lab Technician,Pharmacist]',
            'phone' => 'required|max_length[20]',
            'salary' => 'required|decimal',
            'joining_date' => 'required|valid_date',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'salary' => $this->request->getPost('salary'),
            'joining_date' => $this->request->getPost('joining_date'),
            'qualification' => $this->request->getPost('qualification'),
            'status' => $this->request->getPost('status'),
        ];
        
        $this->staffModel->update($id, $data);
        
        return redirect()->to('admin/staff')
                        ->with('success', 'Staff member updated successfully.');
    }
    
    public function delete($id)
    {
        $staff = $this->staffModel->find($id);
        
        if (!$staff) {
            return redirect()->to('admin/staff')
                            ->with('error', 'Staff member not found.');
        }
        
        $this->staffModel->delete($id);
        
        return redirect()->to('admin/staff')
                        ->with('success', 'Staff member deleted successfully.');
    }
}
