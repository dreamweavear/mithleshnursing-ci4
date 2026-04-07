<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'role', 'email', 'phone', 'address', 'salary', 
        'joining_date', 'qualification', 'status',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'role' => 'required|in_list[Doctor,Nurse,Receptionist,Lab Technician,Pharmacist]',
        'phone' => 'required|max_length[20]',
        'salary' => 'required|decimal',
        'joining_date' => 'required|valid_date',
    ];
    
    public function getStaffCount()
    {
        return $this->where('status', 'Active')->countAllResults();
    }
    
    public function getDoctorsCount()
    {
        return $this->where('role', 'Doctor')->where('status', 'Active')->countAllResults();
    }
}
