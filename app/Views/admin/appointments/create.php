<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Book Appointment / OPD Registration</h4>
    <a href="<?= base_url('admin/appointments') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/appointments/store') ?>" method="POST">
        <?= csrf_field() ?>

        <!-- Patient Type -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Patient Type <span class="text-danger">*</span></label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="appt_type" id="typeOPD" value="OPD" checked>
                    <label class="form-check-label fw-semibold text-info" for="typeOPD">OPD (Out-Patient)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="appt_type" id="typeIPD" value="IPD">
                    <label class="form-check-label fw-semibold text-danger" for="typeIPD">IPD (In-Patient)</label>
                </div>
            </div>
        </div>

        <!-- Patient Search -->
        <div class="card border-primary mb-4">
            <div class="card-header bg-primary text-white py-2">
                <i class="bi bi-search me-2"></i>Search Existing Patient (by Name, UHID, or Phone)
            </div>
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-md-8">
                        <div style="position:relative;">
                            <input type="text" id="patientSearch" class="form-control" placeholder="Type name, UHID (SNH...) or phone number...">
                            <div id="searchResults" class="list-group shadow" style="position:absolute; top:100%; left:0; right:0; z-index:1050; max-height:250px; overflow-y:auto;"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Or fill details manually below for new patient</small>
                    </div>
                </div>
                <input type="hidden" name="patient_ref_id" id="patientRefId">
                <div id="selectedPatientBadge" class="mt-2"></div>
            </div>
        </div>

        <!-- Patient Details -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Name <span class="text-danger">*</span></label>
                <input type="text" name="patient_name" id="fieldName" class="form-control" value="<?= old('patient_name') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Patient Phone <span class="text-danger">*</span></label>
                <input type="text" name="patient_phone" id="fieldPhone" class="form-control" value="<?= old('patient_phone') ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Patient Email</label>
            <input type="email" name="patient_email" id="fieldEmail" class="form-control" value="<?= old('patient_email') ?>">
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

        <h5 class="mt-4 mb-3">Vital Signs <small class="text-muted fw-normal fs-6">(Optional)</small></h5>
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

        <div class="text-end">
            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Book Appointment</button>
        </div>
    </form>
</div>

<script>
(function () {
    var searchInput   = document.getElementById('patientSearch');
    var resultsDiv    = document.getElementById('searchResults');
    var refIdField    = document.getElementById('patientRefId');
    var badgeDiv      = document.getElementById('selectedPatientBadge');
    var fieldName     = document.getElementById('fieldName');
    var fieldPhone    = document.getElementById('fieldPhone');
    var fieldEmail    = document.getElementById('fieldEmail');
    var searchTimer;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimer);
        var q = this.value.trim();
        if (q.length < 2) { resultsDiv.innerHTML = ''; return; }
        searchTimer = setTimeout(function () {
            fetch('<?= base_url('admin/patients/search') ?>?q=' + encodeURIComponent(q), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(r) {
                    if (!r.ok) throw new Error('Server error: ' + r.status);
                    return r.json();
                })
                .then(function(data) {
                    resultsDiv.innerHTML = '';
                    if (!data.length) {
                        resultsDiv.innerHTML = '<div class="list-group-item text-muted small">No patient found — fill details manually below</div>';
                        return;
                    }
                    data.forEach(function(p) {
                        var item = document.createElement('button');
                        item.type = 'button';
                        item.className = 'list-group-item list-group-item-action py-2';
                        item.innerHTML = '<strong>' + p.name + '</strong>'
                            + ' <span class="badge bg-primary ms-1">' + p.patient_id + '</span>'
                            + ' <span class="badge bg-' + (p.patient_type === 'IPD' ? 'danger' : 'info') + ' ms-1">' + p.patient_type + '</span>'
                            + '<br><small class="text-muted">' + p.phone + '</small>';
                        item.addEventListener('click', function() {
                            refIdField.value  = p.id;
                            fieldName.value   = p.name;
                            fieldPhone.value  = p.phone;
                            fieldEmail.value  = p.email || '';
                            searchInput.value = p.name + ' (' + p.patient_id + ')';
                            resultsDiv.innerHTML = '';
                            badgeDiv.innerHTML = '<span class="badge bg-success fs-6 mt-2">'
                                + '<i class="bi bi-person-check me-1"></i>Linked: ' + p.patient_id + ' — ' + p.name
                                + '</span>';
                        });
                        resultsDiv.appendChild(item);
                    });
                })
                .catch(function(err) {
                    resultsDiv.innerHTML = '<div class="list-group-item text-danger small">Search error: ' + err.message + '</div>';
                });
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (!resultsDiv.contains(e.target) && e.target !== searchInput) {
            resultsDiv.innerHTML = '';
        }
    });
})();
</script>
<?= $this->endSection() ?>
