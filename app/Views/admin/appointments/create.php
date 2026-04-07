<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Book Appointment</h4>
    <a href="<?= base_url('admin/appointments') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/appointments/store') ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Name <span class="text-danger">*</span></label>
                <input type="text" name="patient_name" class="form-control" value="<?= old('patient_name') ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Phone <span class="text-danger">*</span></label>
                <input type="text" name="patient_phone" class="form-control" value="<?= old('patient_phone') ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Patient Email</label>
            <input type="email" name="patient_email" class="form-control" value="<?= old('patient_email') ?>">
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Select Doctor <span class="text-danger">*</span></label>
                <select name="doctor_id" class="form-select" required>
                    <option value="">Choose Doctor</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>"><?= esc($doctor['name']) ?> - <?= esc($doctor['specialization']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label">Appointment Date <span class="text-danger">*</span></label>
                <input type="date" name="appointment_date" class="form-control" value="<?= old('appointment_date') ?>" required>
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label">Appointment Time <span class="text-danger">*</span></label>
                <input type="time" name="appointment_time" class="form-control" value="<?= old('appointment_time') ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Reason for Visit</label>
            <textarea name="reason" class="form-control" rows="3"><?= old('reason') ?></textarea>
        </div>
        
        <div class="text-end">
            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Book Appointment</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
