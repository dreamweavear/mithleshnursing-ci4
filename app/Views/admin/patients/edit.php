<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Patient</h4>
    <a href="<?= base_url('admin/patients') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/patients/update/' . $patient['id']) ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient ID</label>
                <input type="text" class="form-control" value="<?= $patient['patient_id'] ?>" readonly>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Type <span class="text-danger">*</span></label>
                <select name="patient_type" class="form-select" required>
                    <option value="IPD" <?= $patient['patient_type'] == 'IPD' ? 'selected' : '' ?>>IPD (In-Patient)</option>
                    <option value="OPD" <?= $patient['patient_type'] == 'OPD' ? 'selected' : '' ?>>OPD (Out-Patient)</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= esc($patient['name']) ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($patient['email']) ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="<?= esc($patient['phone']) ?>" required>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label">Gender <span class="text-danger">*</span></label>
                <select name="gender" class="form-select" required>
                    <option value="Male" <?= $patient['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $patient['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $patient['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control" value="<?= $patient['age'] ?>" required min="1" max="150">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" rows="3" required><?= esc($patient['address']) ?></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Admission Date</label>
                <input type="date" name="admission_date" class="form-control" value="<?= $patient['admission_date'] ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Discharge Date</label>
                <input type="date" name="discharge_date" class="form-control" value="<?= $patient['discharge_date'] ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Assign Doctor <span class="text-danger">*</span></label>
                <select name="doctor_id" class="form-select" required>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>" <?= $patient['doctor_id'] == $doctor['id'] ? 'selected' : '' ?>>
                            <?= esc($doctor['name']) ?> - <?= esc($doctor['specialization']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Admitted" <?= $patient['status'] == 'Admitted' ? 'selected' : '' ?>>Admitted</option>
                    <option value="Under Treatment" <?= $patient['status'] == 'Under Treatment' ? 'selected' : '' ?>>Under Treatment</option>
                    <option value="Discharged" <?= $patient['status'] == 'Discharged' ? 'selected' : '' ?>>Discharged</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Room Number</label>
                <input type="text" name="room_number" class="form-control" value="<?= esc($patient['room_number']) ?>">
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label">Bed Number</label>
                <input type="text" name="bed_number" class="form-control" value="<?= esc($patient['bed_number']) ?>">
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label">Bill Amount</label>
                <input type="number" name="bill_amount" class="form-control" value="<?= $patient['bill_amount'] ?>" step="0.01">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Disease/Diagnosis <span class="text-danger">*</span></label>
            <input type="text" name="disease" class="form-control" value="<?= esc($patient['disease']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Detailed Diagnosis</label>
            <textarea name="diagnosis" class="form-control" rows="3"><?= esc($patient['diagnosis']) ?></textarea>
        </div>
        
        <div class="text-end">
            <a href="<?= base_url('admin/patients') ?>" class="btn btn-outline-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary-custom">Update Patient</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
