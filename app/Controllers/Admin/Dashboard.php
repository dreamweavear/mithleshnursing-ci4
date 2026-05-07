<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\StaffModel;
use App\Models\AppointmentModel;
use App\Models\ExpenseModel;
use App\Models\BillModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $patientModel     = new PatientModel();
        $doctorModel      = new DoctorModel();
        $staffModel       = new StaffModel();
        $appointmentModel = new AppointmentModel();
        $expenseModel     = new ExpenseModel();
        $billModel        = new BillModel();

        $today = date('Y-m-d');
        $month = date('m');
        $year  = date('Y');

        // Revenue
        $todayRevenue = $billModel->selectSum('net_amount')
            ->where('DATE(created_at)', $today)
            ->first()['net_amount'] ?? 0;

        $monthRevenue = $billModel->selectSum('net_amount')
            ->where('MONTH(created_at)', $month)
            ->where('YEAR(created_at)', $year)
            ->first()['net_amount'] ?? 0;

        // Expense
        $todayExpense = $expenseModel->selectSum('amount')
            ->where('expense_date', $today)
            ->first()['amount'] ?? 0;

        $monthExpense = $expenseModel->selectSum('amount')
            ->where('MONTH(expense_date)', $month)
            ->where('YEAR(expense_date)', $year)
            ->first()['amount'] ?? 0;

        // Profit
        $profit = $monthRevenue - $monthExpense;

        // Pending Bills
        $pendingBills = $billModel
            ->where('payment_status', 'Pending')
            ->countAllResults();

        // Recent Bills
        $recentBills = $billModel
            ->orderBy('id','DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'totalPatients'     => $patientModel->getTotalPatientCount(),
            'activePatients'    => $patientModel->getActivePatientCount(),
            'todayAdmissions'   => $patientModel->getTodayAdmissions(),
            'totalDoctors'      => $doctorModel->getDoctorCount(),
            'totalStaff'        => $staffModel->getStaffCount(),
            'todayAppointments' => $appointmentModel->getTodayAppointmentCount(),

            'todayRevenue'  => $todayRevenue,
            'monthRevenue'  => $monthRevenue,
            'todayExpense'  => $todayExpense,
            'monthExpense'  => $monthExpense,
            'profit'        => $profit,
            'pendingBills'  => $pendingBills,
            'recentBills'   => $recentBills
        ];

        return view('admin/dashboard/index', $data);
    }
}