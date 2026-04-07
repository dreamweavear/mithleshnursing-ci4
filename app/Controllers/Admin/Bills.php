<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BillModel;
use App\Models\PatientModel;

class Bills extends BaseController
{
    protected $billModel;
    protected $patientModel;
    
    public function __construct()
    {
        $this->billModel = new BillModel();
        $this->patientModel = new PatientModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Billing Management - Mithlesh Nursing Home',
            'bills' => $this->billModel->getBillsWithPatients()
        ];
        
        return view('admin/bills/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Generate Bill - Mithlesh Nursing Home',
            'patients' => $this->patientModel->where('status !=', 'Discharged')->findAll(),
            'billNumber' => $this->billModel->generateBillNumber()
        ];
        
        return view('admin/bills/create', $data);
    }
    
    public function store()
    {
        $rules = [
            'patient_id' => 'required|integer',
            'admission_date' => 'permit_empty|valid_date',
            'discharge_date' => 'permit_empty|valid_date',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $roomCharges = $this->request->getPost('room_charges') ?? 0;
        $doctorFees = $this->request->getPost('doctor_fees') ?? 0;
        $medicineCharges = $this->request->getPost('medicine_charges') ?? 0;
        $testCharges = $this->request->getPost('test_charges') ?? 0;
        $otherCharges = $this->request->getPost('other_charges') ?? 0;
        $discount = $this->request->getPost('discount') ?? 0;
        
        $totalAmount = $roomCharges + $doctorFees + $medicineCharges + $testCharges + $otherCharges;
        $netAmount = $totalAmount - $discount;
        
        $data = [
            'bill_number' => $this->request->getPost('bill_number'),
            'patient_id' => $this->request->getPost('patient_id'),
            'admission_date' => $this->request->getPost('admission_date'),
            'discharge_date' => $this->request->getPost('discharge_date'),
            'room_charges' => $roomCharges,
            'doctor_fees' => $doctorFees,
            'medicine_charges' => $medicineCharges,
            'test_charges' => $testCharges,
            'other_charges' => $otherCharges,
            'total_amount' => $totalAmount,
            'discount' => $discount,
            'net_amount' => $netAmount,
            'payment_status' => $this->request->getPost('payment_status') ?? 'Pending',
            'payment_method' => $this->request->getPost('payment_method'),
            'notes' => $this->request->getPost('notes'),
        ];
        
        $this->billModel->insert($data);
        
        // Update patient bill amount
        $this->patientModel->update($this->request->getPost('patient_id'), [
            'bill_amount' => $netAmount
        ]);
        
        return redirect()->to('admin/bills')
                        ->with('success', 'Bill generated successfully.');
    }
    
    public function view($id)
    {
        $bill = $this->billModel->select('bills.*, patients.name as patient_name, patients.patient_id, patients.age, patients.gender, patients.address')
                                ->join('patients', 'patients.id = bills.patient_id')
                                ->where('bills.id', $id)
                                ->first();
        
        if (!$bill) {
            return redirect()->to('admin/bills')
                            ->with('error', 'Bill not found.');
        }
        
        $data = [
            'title' => 'View Bill - Mithlesh Nursing Home',
            'bill' => $bill
        ];
        
        return view('admin/bills/view', $data);
    }
    
    public function print($id)
    {
        $bill = $this->billModel->select('bills.*, patients.name as patient_name, patients.patient_id, patients.age, patients.gender, patients.address')
                                ->join('patients', 'patients.id = bills.patient_id')
                                ->where('bills.id', $id)
                                ->first();
        
        if (!$bill) {
            return redirect()->to('admin/bills')
                            ->with('error', 'Bill not found.');
        }
        
        $data = [
            'title' => 'Print Bill - Mithlesh Nursing Home',
            'bill' => $bill
        ];
        
        return view('admin/bills/print', $data);
    }
    
    public function updatePayment($id)
    {
        $status = $this->request->getPost('payment_status');
        $method = $this->request->getPost('payment_method');
        
        if (!in_array($status, ['Pending', 'Paid', 'Partial'])) {
            return redirect()->back()
                            ->with('error', 'Invalid payment status.');
        }
        
        $this->billModel->update($id, [
            'payment_status' => $status,
            'payment_method' => $method
        ]);
        
        return redirect()->back()
                        ->with('success', 'Payment status updated.');
    }
    
    public function delete($id)
    {
        $bill = $this->billModel->find($id);
        
        if (!$bill) {
            return redirect()->to('admin/bills')
                            ->with('error', 'Bill not found.');
        }
        
        $this->billModel->delete($id);
        
        return redirect()->to('admin/bills')
                        ->with('success', 'Bill deleted successfully.');
    }
}
