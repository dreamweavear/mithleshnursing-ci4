<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="row g-4 mb-4">
    <!-- Total Patients Card -->
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card">
            <div class="card-icon patients">
                <i class="bi bi-people"></i>
            </div>
            <div class="card-number"><?= $totalPatients ?></div>
            <div class="card-label">Total Patients</div>
        </div>
    </div>
    
    <!-- Active Patients Card -->
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card">
            <div class="card-icon doctors">
                <i class="bi bi-heart-pulse"></i>
            </div>
            <div class="card-number"><?= $activePatients ?></div>
            <div class="card-label">Active Patients</div>
        </div>
    </div>
    
    <!-- Total Doctors Card -->
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card">
            <div class="card-icon staff">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="card-number"><?= $totalDoctors ?></div>
            <div class="card-label">Total Doctors</div>
        </div>
    </div>
    
    <!-- Total Staff Card -->
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card">
            <div class="card-icon appointments">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="card-number"><?= $totalStaff ?></div>
            <div class="card-label">Total Staff</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Today's Stats -->
    <div class="col-md-6">
        <div class="table-container">
            <h5 class="mb-4"><i class="bi bi-calendar-day me-2"></i>Today's Overview</h5>
            <div class="row g-3">
                <div class="col-6">
                    <div class="p-3 bg-light rounded text-center">
                        <h3 class="text-primary mb-1"><?= $todayAdmissions ?></h3>
                        <small class="text-muted">New Admissions</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-light rounded text-center">
                        <h3 class="mb-1" style="color: #7C3AED;"><?= $todayAppointments ?></h3>
                        <small class="text-muted">Appointments</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Links -->
    <div class="col-md-6">
        <div class="table-container">
            <h5 class="mb-4"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
            <div class="row g-3">
                <div class="col-6">
                    <a href="<?= base_url('admin/patients/create') ?>" class="btn btn-primary-custom w-100 py-3">
                        <i class="bi bi-person-plus me-2"></i>Add Patient
                    </a>
                </div>
                <div class="col-6">
                    <a href="<?= base_url('admin/appointments/create') ?>" class="btn btn-primary-custom w-100 py-3">
                        <i class="bi bi-calendar-plus me-2"></i>Book Appointment
                    </a>
                </div>
                <div class="col-6">
                    <a href="<?= base_url('admin/bills/create') ?>" class="btn btn-primary-custom w-100 py-3">
                        <i class="bi bi-receipt me-2"></i>Generate Bill
                    </a>
                </div>
                <div class="col-6">
                    <a href="<?= base_url('admin/inquiries') ?>" class="btn btn-primary-custom w-100 py-3">
                        <i class="bi bi-envelope me-2"></i>View Inquiries
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
