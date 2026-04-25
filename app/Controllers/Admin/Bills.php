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
        
        $roomRate           = (float)($this->request->getPost('room_rate') ?? 0);
        $roomDays           = (int)($this->request->getPost('room_days') ?? 0);
        $roomCharges        = (float)($this->request->getPost('room_charges') ?? 0);
        $doctorFees         = (float)($this->request->getPost('doctor_fees') ?? 0);
        $medicineCharges    = (float)($this->request->getPost('medicine_charges') ?? 0);
        $testCharges        = (float)($this->request->getPost('test_charges') ?? 0);
        $surgeryCharges     = (float)($this->request->getPost('surgery_charges') ?? 0);
        $anaesthesiaCharges = (float)($this->request->getPost('anaesthesia_charges') ?? 0);
        $otCharges          = (float)($this->request->getPost('ot_charges') ?? 0);
        $nursingCharges     = (float)($this->request->getPost('nursing_charges') ?? 0);
        $assistanceCharges  = (float)($this->request->getPost('assistance_charges') ?? 0);
        $otherCharges       = (float)($this->request->getPost('other_charges') ?? 0);
        $discountPercent    = (float)($this->request->getPost('discount_percent') ?? 0);

        $totalAmount = $roomCharges + $doctorFees + $medicineCharges + $testCharges
                     + $surgeryCharges + $anaesthesiaCharges + $otCharges
                     + $nursingCharges + $assistanceCharges + $otherCharges;
        $discount    = round($totalAmount * $discountPercent / 100, 2);
        $netAmount   = $totalAmount - $discount;

        $data = [
            'bill_number'        => $this->request->getPost('bill_number'),
            'patient_id'         => $this->request->getPost('patient_id'),
            'admission_date'     => $this->request->getPost('admission_date'),
            'discharge_date'     => $this->request->getPost('discharge_date'),
            'room_rate'          => $roomRate,
            'room_days'          => $roomDays,
            'room_charges'       => $roomCharges,
            'doctor_fees'        => $doctorFees,
            'medicine_charges'   => $medicineCharges,
            'test_charges'       => $testCharges,
            'surgery_charges'    => $surgeryCharges,
            'anaesthesia_charges'=> $anaesthesiaCharges,
            'ot_charges'         => $otCharges,
            'nursing_charges'    => $nursingCharges,
            'assistance_charges' => $assistanceCharges,
            'other_charges'      => $otherCharges,
            'discount_percent'   => $discountPercent,
            'total_amount'       => $totalAmount,
            'discount'           => $discount,
            'net_amount'         => $netAmount,
            'payment_status'     => $this->request->getPost('payment_status') ?? 'Pending',
            'payment_method'     => $this->request->getPost('payment_method'),
            'notes'              => $this->request->getPost('notes'),
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
    
    public function edit($id)
    {
        $bill = $this->billModel->find($id);

        if (!$bill) {
            return redirect()->to('admin/bills')
                            ->with('error', 'Bill not found.');
        }

        $data = [
            'title'    => 'Edit Bill - Mithlesh Nursing Home',
            'bill'     => $bill,
            'patients' => $this->patientModel->findAll(),
        ];

        return view('admin/bills/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'patient_id'     => 'required|integer',
            'admission_date' => 'permit_empty|valid_date',
            'discharge_date' => 'permit_empty|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $roomRate           = (float)($this->request->getPost('room_rate') ?? 0);
        $roomDays           = (int)($this->request->getPost('room_days') ?? 0);
        $roomCharges        = (float)($this->request->getPost('room_charges') ?? 0);
        $doctorFees         = (float)($this->request->getPost('doctor_fees') ?? 0);
        $medicineCharges    = (float)($this->request->getPost('medicine_charges') ?? 0);
        $testCharges        = (float)($this->request->getPost('test_charges') ?? 0);
        $surgeryCharges     = (float)($this->request->getPost('surgery_charges') ?? 0);
        $anaesthesiaCharges = (float)($this->request->getPost('anaesthesia_charges') ?? 0);
        $otCharges          = (float)($this->request->getPost('ot_charges') ?? 0);
        $nursingCharges     = (float)($this->request->getPost('nursing_charges') ?? 0);
        $assistanceCharges  = (float)($this->request->getPost('assistance_charges') ?? 0);
        $otherCharges       = (float)($this->request->getPost('other_charges') ?? 0);
        $discountPercent    = (float)($this->request->getPost('discount_percent') ?? 0);

        $totalAmount = $roomCharges + $doctorFees + $medicineCharges + $testCharges
                     + $surgeryCharges + $anaesthesiaCharges + $otCharges
                     + $nursingCharges + $assistanceCharges + $otherCharges;
        $discount    = round($totalAmount * $discountPercent / 100, 2);
        $netAmount   = $totalAmount - $discount;

        $data = [
            'patient_id'         => $this->request->getPost('patient_id'),
            'admission_date'     => $this->request->getPost('admission_date'),
            'discharge_date'     => $this->request->getPost('discharge_date'),
            'room_rate'          => $roomRate,
            'room_days'          => $roomDays,
            'room_charges'       => $roomCharges,
            'doctor_fees'        => $doctorFees,
            'medicine_charges'   => $medicineCharges,
            'test_charges'       => $testCharges,
            'surgery_charges'    => $surgeryCharges,
            'anaesthesia_charges'=> $anaesthesiaCharges,
            'ot_charges'         => $otCharges,
            'nursing_charges'    => $nursingCharges,
            'assistance_charges' => $assistanceCharges,
            'other_charges'      => $otherCharges,
            'discount_percent'   => $discountPercent,
            'total_amount'       => $totalAmount,
            'discount'           => $discount,
            'net_amount'         => $netAmount,
            'payment_status'     => $this->request->getPost('payment_status') ?? 'Pending',
            'payment_method'     => $this->request->getPost('payment_method'),
            'notes'              => $this->request->getPost('notes'),
        ];

        $this->billModel->update($id, $data);

        $this->patientModel->update($this->request->getPost('patient_id'), [
            'bill_amount' => $netAmount
        ]);

        return redirect()->to('admin/bills/view/' . $id)
                        ->with('success', 'Bill updated successfully.');
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
