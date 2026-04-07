<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'specialization', 'experience', 'qualification', 
        'availability_time', 'phone', 'email', 'image', 'status',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'specialization' => 'required|max_length[100]',
        'phone' => 'required|max_length[20]',
    ];
    
    public function getActiveDoctors()
    {
        return $this->where('status', 'active')->findAll();
    }
    
    public function getDoctorCount()
    {
        return $this->where('status', 'active')->countAllResults();
    }
}
