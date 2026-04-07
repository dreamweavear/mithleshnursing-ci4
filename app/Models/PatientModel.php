<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'patient_id', 'name', 'email', 'phone', 'gender', 'age', 'address',
        'patient_type', 'admission_date', 'discharge_date', 'disease', 'diagnosis',
        'doctor_id', 'room_number', 'bed_number', 'bill_amount', 'status',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'patient_id' => 'required|is_unique[patients.patient_id]',
        'name' => 'required|min_length[3]|max_length[100]',
        'phone' => 'required|max_length[20]',
        'gender' => 'required|in_list[Male,Female,Other]',
        'age' => 'required|integer|greater_than[0]|less_than[150]',
        'address' => 'required',
        'patient_type' => 'required|in_list[IPD,OPD]',
        'disease' => 'required|max_length[200]',
        'doctor_id' => 'required|integer',
        'status' => 'required|in_list[Admitted,Discharged,Under Treatment]',
    ];
    
    public function generatePatientId()
    {
        $prefix = 'SNH';
        $year = date('Y');
        $lastPatient = $this->orderBy('id', 'DESC')->first();
        
        if ($lastPatient) {
            $lastNumber = intval(substr($lastPatient['patient_id'], -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $year . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    
    public function getPatientsWithDoctors()
    {
        return $this->select('patients.*, doctors.name as doctor_name')
                    ->join('doctors', 'doctors.id = patients.doctor_id')
                    ->findAll();
    }
    
    public function getActivePatientCount()
    {
        return $this->where('status', 'Admitted')->countAllResults();
    }
    
    public function getTotalPatientCount()
    {
        return $this->countAll();
    }
    
    public function getTodayAdmissions()
    {
        return $this->where('DATE(admission_date)', date('Y-m-d'))->countAllResults();
    }
}
