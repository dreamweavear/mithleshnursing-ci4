<?php

namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'bill_number', 'patient_id', 'admission_date', 'discharge_date',
        'room_charges', 'doctor_fees', 'medicine_charges', 'test_charges',
        'other_charges', 'total_amount', 'discount', 'net_amount',
        'payment_status', 'payment_method', 'notes',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'bill_number' => 'required|is_unique[bills.bill_number]',
        'patient_id' => 'required|integer',
        'total_amount' => 'required|decimal',
    ];
    
    public function generateBillNumber()
    {
        $prefix = 'BILL';
        $year = date('Y');
        $month = date('m');
        $lastBill = $this->orderBy('id', 'DESC')->first();
        
        if ($lastBill) {
            $lastNumber = intval(substr($lastBill['bill_number'], -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $year . $month . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    
    public function getBillsWithPatients()
    {
        return $this->select('bills.*, patients.name as patient_name, patients.patient_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->orderBy('bills.created_at', 'DESC')
                    ->findAll();
    }
    
    public function calculateTotal()
    {
        return $this->selectSum('net_amount', 'total')
                    ->where('payment_status', 'Paid')
                    ->first()['total'] ?? 0;
    }
}
