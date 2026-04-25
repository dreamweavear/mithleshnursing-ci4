<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'patient_name', 'patient_phone', 'patient_email', 'doctor_id',
        'appointment_date', 'appointment_time', 'reason', 'status', 'notes',
        'patient_ref_id', 'appt_type',
        'bp', 'pulse', 'spo2', 'rr', 'temperature', 'weight',
        'chief_complaint', 'diagnosis', 'prescription', 'advice', 'followup_date',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'patient_name' => 'required|min_length[3]|max_length[100]',
        'patient_phone' => 'required|max_length[20]',
        'doctor_id' => 'required|integer',
        'appointment_date' => 'required|valid_date',
        'appointment_time' => 'required',
        'status' => 'required|in_list[Pending,Confirmed,Completed,Cancelled]',
    ];
    
    public function getAppointmentsWithDoctors()
    {
        return $this->select('appointments.*, doctors.name as doctor_name, doctors.specialization')
                    ->join('doctors', 'doctors.id = appointments.doctor_id')
                    ->orderBy('appointment_date', 'DESC')
                    ->findAll();
    }

    public function getAppointmentsWithPatientLink()
    {
        return $this->select('appointments.*, doctors.name as doctor_name, doctors.specialization, patients.patient_id as uhid')
                    ->join('doctors', 'doctors.id = appointments.doctor_id')
                    ->join('patients', 'patients.id = appointments.patient_ref_id', 'left')
                    ->orderBy('appointments.appointment_date', 'DESC')
                    ->findAll();
    }
    /*
    public function getTodayAppointments()
    {
        return $this->select('appointments.*, doctors.name as doctor_name')
                    ->join('doctors', 'doctors.id = appointments.doctor_id')
                    ->where('DATE(appointment_date)', date('Y-m-d'))
                    ->where('status !=', 'Cancelled')
                    ->findAll();
    }

    */

    public function getTodayAppointments()
{
    return $this->select('appointments.*, doctors.name as doctor_name')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->where('DATE(appointments.appointment_date)', date('Y-m-d'))
                ->where('appointments.status !=', 'Cancelled')
                ->findAll();
}



    /*
    public function getTodayAppointmentCount()
    {
        return $this->where('DATE(appointment_date)', date('Y-m-d'))
                    ->where('status !=', 'Cancelled')
                    ->countAllResults();
    }

    */

    public function getTodayAppointmentCount()
{
    return $this->where('DATE(appointments.appointment_date)', date('Y-m-d'))
                ->where('appointments.status !=', 'Cancelled')
                ->countAllResults();
}




}
