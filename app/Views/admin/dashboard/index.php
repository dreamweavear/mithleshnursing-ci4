<!-- app/Views/admin/dashboard/index.php -->

<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

<h2 class="fw-bold mb-4">Dashboard</h2>

<div class="row g-4 mb-4">

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>Total Patients</div>
<h3><?= $totalPatients ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>Today Appointments</div>
<h3><?= $todayAppointments ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>This Month Revenue</div>
<h3 class="text-success">₹<?= number_format($monthRevenue) ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>This Month Expense</div>
<h3 class="text-danger">₹<?= number_format($monthExpense) ?></h3>
</div>
</div>

</div>



<div class="row g-4 mb-4">

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>Today Revenue</div>
<h4 class="text-success">₹<?= number_format($todayRevenue) ?></h4>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>Today Expense</div>
<h4 class="text-danger">₹<?= number_format($todayExpense) ?></h4>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>Pending Bills</div>
<h4 class="text-warning"><?= $pendingBills ?></h4>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm border-0 p-3">
<div>Profit This Month</div>
<h4 class="text-primary">₹<?= number_format($profit) ?></h4>
</div>
</div>

</div>



<div class="row g-4">

<div class="col-lg-6">
<div class="card shadow-sm border-0 p-4">
<h5 class="mb-3">Recent Bills</h5>

<table class="table table-sm">
<tr>
<th>Bill No</th>
<th>Amount</th>
<th>Status</th>
</tr>

<?php foreach($recentBills as $bill): ?>
<tr>
<td><?= $bill['bill_number'] ?></td>
<td>₹<?= number_format($bill['net_amount']) ?></td>
<td><?= $bill['payment_status'] ?></td>
</tr>
<?php endforeach; ?>

</table>

</div>
</div>


<div class="col-lg-6">
<div class="card shadow-sm border-0 p-4">
<h5 class="mb-3">Quick Actions</h5>

<div class="row g-3">

<div class="col-6">
<a href="<?= base_url('admin/patients/create') ?>" class="btn btn-primary w-100">
Add Patient
</a>
</div>

<div class="col-6">
<a href="<?= base_url('admin/appointments/create') ?>" class="btn btn-success w-100">
Appointment
</a>
</div>

<div class="col-6">
<a href="<?= base_url('admin/bills/create') ?>" class="btn btn-warning w-100">
Generate Bill
</a>
</div>

<div class="col-6">
<a href="<?= base_url('admin/inquiries') ?>" class="btn btn-dark w-100">
Inquiries
</a>
</div>

</div>

</div>
</div>

</div>

</div>

<?= $this->endSection() ?>