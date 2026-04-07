<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Appointment</h4>
    <a href="<?= base_url('admin/appointments') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/appointments/update/' . $appointment['id']) ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Name <span class="text-danger">*</span></label>
                <input type="text" name="patient_name" class="form-control" value="<?= esc($appointment['patient_name']) ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Phone <span class="text-danger">*</span></label>
                <input type="text" name="patient_phone" class="form-control" value="<?= esc($appointment['patient_phone']) ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Patient Email</label>
            <input type="email" name="patient_email" class="form-control" value="<?= esc($appointment['patient_email']) ?>">
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Select Doctor <span class="text-danger">*</span></label>
                <select name="doctor_id" class="form-select" required>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>" <?= $appointment['doctor_id'] == $doctor['id'] ? 'selected' : '' ?>>
                            <?= esc($doctor['name']) ?> - <?= esc($doctor['specialization']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label">Appointment Date <span class="text-danger">*</span></label>
                <input type="date" name="appointment_date" class="form-control" value="<?= $appointment['appointment_date'] ?>" required>
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label">Appointment Time <span class="text-danger">*</span></label>
                <input type="time" name="appointment_time" class="form-control" value="<?= $appointment['appointment_time'] ?>" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Pending" <?= $appointment['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Confirmed" <?= $appointment['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                    <option value="Completed" <?= $appointment['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="Cancelled" <?= $appointment['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Reason for Visit</label>
            <textarea name="reason" class="form-control" rows="3"><?= esc($appointment['reason']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes..."><?= esc($appointment['notes']) ?></textarea>
        </div>
        
        <div class="text-end">
            <a href="<?= base_url('admin/appointments') ?>" class="btn btn-outline-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary-custom">Update Appointment</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
