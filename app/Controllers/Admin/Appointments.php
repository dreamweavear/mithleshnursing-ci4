<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\DoctorModel;
use App\Models\PatientModel;
//whatsapp message send karne ke liye library import kiya hai
use App\Libraries\WhatsAppService;

class Appointments extends BaseController
{
    protected $appointmentModel;
    protected $doctorModel;
    protected $patientModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->doctorModel = new DoctorModel();
        $this->patientModel = new PatientModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Appointment Management - Mithlesh Nursing Home',
            'appointments' => $this->appointmentModel->getAppointmentsWithDoctors()
        ];
        
        return view('admin/appointments/index', $data);
    }
    
    public function today()
    {
        $data = [
            'title' => 'Today\'s Appointments - Mithlesh Nursing Home',
            'appointments' => $this->appointmentModel->getTodayAppointments()
        ];
        
        return view('admin/appointments/today', $data);
    }
    
    public function create()
    {
        $data = [
            'title'    => 'Book Appointment - Mithlesh Nursing Home',
            'doctors'  => $this->doctorModel->getActiveDoctors(),
            'patients' => $this->patientModel->select('id, patient_id, name, phone, email')->findAll(),
        ];

        return view('admin/appointments/create', $data);
    }
    
    public function store()
    {
        $rules = [
            'patient_name' => 'required|min_length[3]|max_length[100]',
            'patient_phone' => 'required|max_length[20]',
            'doctor_id' => 'required|integer',
            'appointment_date' => 'required|valid_date',
            'appointment_time' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'patient_name'     => $this->request->getPost('patient_name'),
            'patient_phone'    => $this->request->getPost('patient_phone'),
            'patient_email'    => $this->request->getPost('patient_email'),
            'doctor_id'        => $this->request->getPost('doctor_id'),
            'appointment_date' => $this->request->getPost('appointment_date'),
            'appointment_time' => $this->request->getPost('appointment_time'),
            'reason'           => $this->request->getPost('reason'),
            'status'           => 'Pending',
            'patient_ref_id'   => $this->request->getPost('patient_ref_id') ?: null,
            'appt_type'        => $this->request->getPost('appt_type') ?? 'OPD',
            'bp'               => $this->request->getPost('bp') ?: null,
            'pulse'            => $this->request->getPost('pulse') ?: null,
            'spo2'             => $this->request->getPost('spo2') ?: null,
            'rr'               => $this->request->getPost('rr') ?: null,
            'temperature'      => $this->request->getPost('temperature') ?: null,
            'weight'           => $this->request->getPost('weight') ?: null,
        ];

        $this->appointmentModel->insert($data);
        // WhatsApp message send karne ke liye code
            // ================= WHATSAPP SEND =================

$whatsapp = new WhatsAppService();

$doctor = $this->doctorModel->find($this->request->getPost('doctor_id'));

$phone = $this->request->getPost('patient_phone');

// 10 digit ho to India code add kare
$phone = preg_replace('/[^0-9]/', '', $phone);
if(strlen($phone) == 10){
    $phone = '91' . $phone;
}

$message = "Namaste " . $this->request->getPost('patient_name') . ",\n\n"
          . "Your appointment has been booked successfully.\n\n"
          . "Doctor: " . $doctor['name'] . "\n"
          . "Date: " . $this->request->getPost('appointment_date') . "\n"
          . "Time: " . $this->request->getPost('appointment_time') . "\n\n"
          . "Mithlesh Nursing Home";

$whatsapp->send($phone, $message);

// ================================================
        // w hatsapp  code ends here
        
        return redirect()->to('admin/appointments')
                        ->with('success', 'Appointment booked successfully.');
    }
    
    public function edit($id)
    {
        $appointment = $this->appointmentModel->find($id);
        
        if (!$appointment) {
            return redirect()->to('admin/appointments')
                            ->with('error', 'Appointment not found.');
        }
        
        $data = [
            'title' => 'Edit Appointment - Mithlesh Nursing Home',
            'appointment' => $appointment,
            'doctors' => $this->doctorModel->getActiveDoctors()
        ];
        
        return view('admin/appointments/edit', $data);
    }
    
    public function update($id)
    {
        $rules = [
            'patient_name' => 'required|min_length[3]|max_length[100]',
            'patient_phone' => 'required|max_length[20]',
            'doctor_id' => 'required|integer',
            'appointment_date' => 'required|valid_date',
            'appointment_time' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'patient_name'     => $this->request->getPost('patient_name'),
            'patient_phone'    => $this->request->getPost('patient_phone'),
            'patient_email'    => $this->request->getPost('patient_email'),
            'doctor_id'        => $this->request->getPost('doctor_id'),
            'appointment_date' => $this->request->getPost('appointment_date'),
            'appointment_time' => $this->request->getPost('appointment_time'),
            'reason'           => $this->request->getPost('reason'),
            'status'           => $this->request->getPost('status'),
            'notes'            => $this->request->getPost('notes'),
            'patient_ref_id'   => $this->request->getPost('patient_ref_id') ?: null,
            'appt_type'        => $this->request->getPost('appt_type') ?? 'OPD',
            'bp'               => $this->request->getPost('bp') ?: null,
            'pulse'            => $this->request->getPost('pulse') ?: null,
            'spo2'             => $this->request->getPost('spo2') ?: null,
            'rr'               => $this->request->getPost('rr') ?: null,
            'temperature'      => $this->request->getPost('temperature') ?: null,
            'weight'           => $this->request->getPost('weight') ?: null,
        ];

        $this->appointmentModel->update($id, $data);
        
        return redirect()->to('admin/appointments')
                        ->with('success', 'Appointment updated successfully.');
    }
    
    public function delete($id)
    {
        $appointment = $this->appointmentModel->find($id);
        
        if (!$appointment) {
            return redirect()->to('admin/appointments')
                            ->with('error', 'Appointment not found.');
        }
        
        $this->appointmentModel->delete($id);
        
        return redirect()->to('admin/appointments')
                        ->with('success', 'Appointment deleted successfully.');
    }
    
    public function view($id)
    {
        $appointment = $this->appointmentModel
            ->select('appointments.*, doctors.name as doctor_name, doctors.specialization, doctors.phone as doctor_phone')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->where('appointments.id', $id)
            ->first();

        if (!$appointment) {
            return redirect()->to('admin/appointments')
                            ->with('error', 'Appointment not found.');
        }

        $data = [
            'title'       => 'Appointment Details - Mithlesh Nursing Home',
            'appointment' => $appointment,
        ];

        return view('admin/appointments/view', $data);
    }

    public function savePrescription($id)
    {
        $appointment = $this->appointmentModel->find($id);

        if (!$appointment) {
            return redirect()->to('admin/appointments')
                            ->with('error', 'Appointment not found.');
        }

        $data = [
            'chief_complaint' => $this->request->getPost('chief_complaint') ?: null,
            'diagnosis'       => $this->request->getPost('diagnosis') ?: null,
            'prescription'    => $this->request->getPost('prescription') ?: null,
            'advice'          => $this->request->getPost('advice') ?: null,
            'followup_date'   => $this->request->getPost('followup_date') ?: null,
            'status'          => 'Completed',
        ];

        $this->appointmentModel->update($id, $data);

        return redirect()->to('admin/appointments/view/' . $id)
                        ->with('success', 'Prescription saved successfully.');
    }

    public function printPrescription($id)
    {
        $appointment = $this->appointmentModel
            ->select('appointments.*, doctors.name as doctor_name, doctors.specialization')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->where('appointments.id', $id)
            ->first();

        if (!$appointment) {
            return redirect()->to('admin/appointments')
                            ->with('error', 'Appointment not found.');
        }

        return view('admin/appointments/prescription_print', ['appointment' => $appointment]);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        
        if (!in_array($status, ['Pending', 'Confirmed', 'Completed', 'Cancelled'])) {
            return redirect()->back()
                            ->with('error', 'Invalid status.');
        }
        
        $this->appointmentModel->update($id, ['status' => $status]);
        
        return redirect()->back()
                        ->with('success', 'Appointment status updated.');
    }
}
