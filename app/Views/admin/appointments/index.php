<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Appointment Management</h4>
    <div>
        <a href="<?= base_url('admin/appointments/today') ?>" class="btn btn-info me-2">
            <i class="bi bi-calendar-day me-2"></i>Today's Appointments
        </a>
        <a href="<?= base_url('admin/appointments/create') ?>" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-2"></i>Book Appointment
        </a>
    </div>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
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
                            <td><?= date('d M Y', strtotime($appointment['appointment_date'])) ?></td>
                            <td><?= date('h:i A', strtotime($appointment['appointment_time'])) ?></td>
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
                                <a href="<?= base_url('admin/appointments/view/' . $appointment['id']) ?>" class="btn btn-sm btn-success me-1" title="View / Prescription">
                                    <i class="bi bi-clipboard2-pulse"></i>
                                </a>
                                <a href="<?= base_url('admin/appointments/edit/' . $appointment['id']) ?>" class="btn btn-sm btn-primary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/appointments/delete/' . $appointment['id']) ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this appointment?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No appointments found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
