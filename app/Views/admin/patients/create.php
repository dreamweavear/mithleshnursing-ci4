<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add New Patient</h4>
    <a href="<?= base_url('admin/patients') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/patients/store') ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient ID <span class="text-danger">*</span></label>
                <input type="text" name="patient_id" class="form-control" value="<?= $patientId ?>" readonly>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Type <span class="text-danger">*</span></label>
                <select name="patient_type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="IPD">IPD (In-Patient)</option>
                    <option value="OPD">OPD (Out-Patient)</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" required>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label">Gender <span class="text-danger">*</span></label>
                <select name="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control" value="<?= old('age') ?>" required min="1" max="150">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" rows="3" required><?= old('address') ?></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Admission Date</label>
                <input type="date" name="admission_date" class="form-control" value="<?= old('admission_date') ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Assign Doctor <span class="text-danger">*</span></label>
                <select name="doctor_id" class="form-select" required>
                    <option value="">Select Doctor</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>"><?= esc($doctor['name']) ?> - <?= esc($doctor['specialization']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Room Number</label>
                <input type="text" name="room_number" class="form-control" value="<?= old('room_number') ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Bed Number</label>
                <input type="text" name="bed_number" class="form-control" value="<?= old('bed_number') ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Disease/Diagnosis <span class="text-danger">*</span></label>
                <input type="text" name="disease" class="form-control" value="<?= old('disease') ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Admitted">Admitted</option>
                    <option value="Under Treatment">Under Treatment</option>
                    <option value="Discharged">Discharged</option>
                </select>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Detailed Diagnosis</label>
            <textarea name="diagnosis" class="form-control" rows="3"><?= old('diagnosis') ?></textarea>
        </div>
        
        <h5 class="mt-4 mb-3">Vital Signs at Registration <small class="text-muted fw-normal fs-6">(Optional)</small></h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">BP (Blood Pressure)</label>
                <input type="text" name="bp" class="form-control" placeholder="e.g. 120/80" value="<?= old('bp') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Pulse <small class="text-muted">(beats/min)</small></label>
                <input type="number" name="pulse" class="form-control" placeholder="72" min="0" max="250" value="<?= old('pulse') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">SpO2 / Oxygen <small class="text-muted">(%)</small></label>
                <input type="number" name="spo2" class="form-control" placeholder="98" min="0" max="100" value="<?= old('spo2') ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">RR (Respiration Rate) <small class="text-muted">(breaths/min)</small></label>
                <input type="number" name="rr" class="form-control" placeholder="16" min="0" max="100" value="<?= old('rr') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Temperature <small class="text-muted">(°F)</small></label>
                <input type="number" name="temperature" class="form-control" placeholder="98.6" min="90" max="115" step="0.1" value="<?= old('temperature') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Weight <small class="text-muted">(kg)</small></label>
                <input type="number" name="weight" class="form-control" placeholder="65.5" min="0" max="300" step="0.1" value="<?= old('weight') ?>">
            </div>
        </div>
        <div id="opdNote" class="alert alert-info py-2 mb-3" style="display:none;">
            <i class="bi bi-info-circle me-2"></i>OPD patient: An appointment will be automatically created with these vitals.
        </div>

        <div class="text-end">
            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Save Patient</button>
        </div>
    </form>
</div>

<script>
(function() {
    var typeSelect = document.querySelector('select[name="patient_type"]');
    var opdNote = document.getElementById('opdNote');
    function checkType() {
        if (typeSelect.value === 'OPD') {
            opdNote.style.display = '';
        } else {
            opdNote.style.display = 'none';
        }
    }
    typeSelect.addEventListener('change', checkType);
    checkType();
})();
</script>
<?= $this->endSection() ?>
