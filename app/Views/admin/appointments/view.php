<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-calendar2-check me-2"></i>Appointment Details</h4>
    <div>
        <a href="<?= base_url('admin/appointments/print-prescription/' . $appointment['id']) ?>"
           class="btn btn-outline-success me-2" target="_blank">
            <i class="bi bi-printer me-2"></i>Print Prescription
        </a>
        <a href="<?= base_url('admin/appointments/edit/' . $appointment['id']) ?>" class="btn btn-primary me-2">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
        <a href="<?= base_url('admin/appointments') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row mb-4">
    <!-- Patient & Appointment Info -->
    <div class="col-md-6">
        <div class="table-container h-100">
            <h5 class="mb-3"><i class="bi bi-person me-2"></i>Patient Details</h5>
            <table class="table table-borderless mb-0">
                <tr>
                    <td width="40%"><strong>Patient Name</strong></td>
                    <td><?= esc($appointment['patient_name']) ?></td>
                </tr>
                <tr>
                    <td><strong>Phone</strong></td>
                    <td><?= esc($appointment['patient_phone']) ?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td><?= $appointment['patient_email'] ? esc($appointment['patient_email']) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Type</strong></td>
                    <td>
                        <span class="badge bg-<?= ($appointment['appt_type'] ?? 'OPD') === 'IPD' ? 'danger' : 'info' ?>">
                            <?= esc($appointment['appt_type'] ?? 'OPD') ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Doctor</strong></td>
                    <td><?= esc($appointment['doctor_name']) ?> <small class="text-muted">(<?= esc($appointment['specialization']) ?>)</small></td>
                </tr>
                <tr>
                    <td><strong>Date &amp; Time</strong></td>
                    <td><?= date('d M Y', strtotime($appointment['appointment_date'])) ?> at <?= date('h:i A', strtotime($appointment['appointment_time'])) ?></td>
                </tr>
                <tr>
                    <td><strong>Reason</strong></td>
                    <td><?= nl2br(esc($appointment['reason'] ?? '')) ?: 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td>
                        <span class="badge bg-<?=
                            $appointment['status'] === 'Pending'   ? 'warning' :
                            ($appointment['status'] === 'Confirmed' ? 'info' :
                            ($appointment['status'] === 'Completed' ? 'success' : 'danger'))
                        ?>">
                            <?= $appointment['status'] ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Vitals -->
    <div class="col-md-6">
        <div class="table-container h-100">
            <h5 class="mb-3"><i class="bi bi-heart-pulse me-2"></i>Vital Signs</h5>
            <?php
            $hasVitals = !empty($appointment['bp']) || !empty($appointment['pulse']) ||
                         !empty($appointment['spo2']) || !empty($appointment['rr']) ||
                         !empty($appointment['temperature']) || !empty($appointment['weight']);
            ?>
            <?php if ($hasVitals): ?>
            <div class="row g-3">
                <?php if (!empty($appointment['bp'])): ?>
                <div class="col-6">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small"><i class="bi bi-activity"></i> BP</div>
                        <div class="fw-bold"><?= esc($appointment['bp']) ?> mmHg</div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($appointment['pulse'])): ?>
                <div class="col-6">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small"><i class="bi bi-heart"></i> Pulse</div>
                        <div class="fw-bold"><?= esc($appointment['pulse']) ?> bpm</div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($appointment['spo2'])): ?>
                <div class="col-6">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small"><i class="bi bi-lungs"></i> SpO2</div>
                        <div class="fw-bold"><?= esc($appointment['spo2']) ?>%</div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($appointment['rr'])): ?>
                <div class="col-6">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small"><i class="bi bi-wind"></i> RR</div>
                        <div class="fw-bold"><?= esc($appointment['rr']) ?> breaths/min</div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($appointment['temperature'])): ?>
                <div class="col-6">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small"><i class="bi bi-thermometer-half"></i> Temp</div>
                        <div class="fw-bold"><?= esc($appointment['temperature']) ?> °F</div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($appointment['weight'])): ?>
                <div class="col-6">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small"><i class="bi bi-person-arms-up"></i> Weight</div>
                        <div class="fw-bold"><?= esc($appointment['weight']) ?> kg</div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <p class="text-muted">No vitals recorded.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Prescription Form -->
<div class="table-container">
    <h5 class="mb-4"><i class="bi bi-clipboard2-pulse me-2"></i>Doctor's Prescription / OPD Advice</h5>

    <form action="<?= base_url('admin/appointments/prescription/' . $appointment['id']) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Chief Complaint</label>
                <textarea name="chief_complaint" class="form-control" rows="3"
                    placeholder="e.g. Fever and headache since 2 days"><?= esc($appointment['chief_complaint'] ?? '') ?></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Diagnosis</label>
                <textarea name="diagnosis" class="form-control" rows="3"
                    placeholder="e.g. Viral fever, Upper respiratory tract infection"><?= esc($appointment['diagnosis'] ?? '') ?></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Prescription / Medicines</label>
            <textarea name="prescription" class="form-control" rows="6"
                placeholder="e.g.&#10;1. Tab Paracetamol 500mg — BD x 5 days&#10;2. Tab Azithromycin 500mg — OD x 3 days&#10;3. Syp Benadryl 10ml — TDS x 5 days"><?= esc($appointment['prescription'] ?? '') ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label fw-semibold">Advice</label>
                <textarea name="advice" class="form-control" rows="3"
                    placeholder="e.g. Take rest, drink plenty of fluids, avoid cold food"><?= esc($appointment['advice'] ?? '') ?></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Follow-up Date</label>
                <input type="date" name="followup_date" class="form-control"
                    value="<?= esc($appointment['followup_date'] ?? '') ?>">
            </div>
        </div>

        <div class="text-end">
            <a href="<?= base_url('admin/appointments/print-prescription/' . $appointment['id']) ?>"
               class="btn btn-outline-success me-2" target="_blank">
                <i class="bi bi-printer me-2"></i>Print Prescription
            </a>
            <button type="submit" class="btn btn-primary-custom">
                <i class="bi bi-save me-2"></i>Save Prescription
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
