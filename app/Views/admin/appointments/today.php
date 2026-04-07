<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Today's Appointments</h4>
    <div>
        <a href="<?= base_url('admin/appointments') ?>" class="btn btn-outline-secondary me-2">
            <i class="bi bi-arrow-left me-2"></i>All Appointments
        </a>
        <a href="<?= base_url('admin/appointments/create') ?>" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-2"></i>Book Appointment
        </a>
    </div>
</div>

<div class="table-container mb-4">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="p-3 bg-primary text-white rounded text-center">
                <h3 class="mb-1"><?= count($appointments) ?></h3>
                <small>Total Appointments Today</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 bg-warning text-dark rounded text-center">
                <h3 class="mb-1"><?= count(array_filter($appointments, fn($a) => $a['status'] == 'Pending')) ?></h3>
                <small>Pending</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 bg-success text-white rounded text-center">
                <h3 class="mb-1"><?= count(array_filter($appointments, fn($a) => $a['status'] == 'Completed')) ?></h3>
                <small>Completed</small>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Doctor</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($appointments)): ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= $appointment['id'] ?></td>
                            <td><?= esc($appointment['patient_name']) ?></td>
                            <td><?= esc($appointment['patient_phone']) ?></td>
                            <td><?= esc($appointment['doctor_name']) ?></td>
                            <td><?= date('h:i A', strtotime($appointment['appointment_time'])) ?></td>
                            <td><?= character_limiter($appointment['reason'], 30) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $appointment['status'] == 'Pending' ? 'warning' : 
                                    ($appointment['status'] == 'Confirmed' ? 'info' : 
                                    ($appointment['status'] == 'Completed' ? 'success' : 'danger')) 
                                ?>">
                                    <?= $appointment['status'] ?>
                                </span>
                            </td>
                            <td>
                                <form action="<?= base_url('admin/appointments/update-status/' . $appointment['id']) ?>" method="POST" class="d-inline">
                                    <?= csrf_field() ?>
                                    <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                        <option value="Pending" <?= $appointment['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="Confirmed" <?= $appointment['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                        <option value="Completed" <?= $appointment['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="Cancelled" <?= $appointment['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No appointments for today</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
