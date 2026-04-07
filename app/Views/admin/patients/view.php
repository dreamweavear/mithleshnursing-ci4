<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Patient Details</h4>
    <div>
        <a href="<?= base_url('admin/patients') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
        <a href="<?= base_url('admin/patients/edit/' . $patient['id']) ?>" class="btn btn-primary ms-2">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="table-container mb-4">
            <h5 class="mb-4"><i class="bi bi-person me-2"></i>Personal Information</h5>
            <table class="table table-borderless">
                <tr>
                    <td width="30%"><strong>Patient ID:</strong></td>
                    <td><span class="badge bg-primary fs-6"><?= $patient['patient_id'] ?></span></td>
                </tr>
                <tr>
                    <td><strong>Full Name:</strong></td>
                    <td><?= esc($patient['name']) ?></td>
                </tr>
                <tr>
                    <td><strong>Age / Gender:</strong></td>
                    <td><?= $patient['age'] ?> years / <?= $patient['gender'] ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?= $patient['email'] ?: 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td><?= esc($patient['phone']) ?></td>
                </tr>
                <tr>
                    <td><strong>Address:</strong></td>
                    <td><?= nl2br(esc($patient['address'])) ?></td>
                </tr>
            </table>
        </div>
        
        <div class="table-container mb-4">
            <h5 class="mb-4"><i class="bi bi-heart-pulse me-2"></i>Medical Information</h5>
            <table class="table table-borderless">
                <tr>
                    <td width="30%"><strong>Patient Type:</strong></td>
                    <td>
                        <span class="badge bg-<?= $patient['patient_type'] == 'IPD' ? 'danger' : 'info' ?> fs-6">
                            <?= $patient['patient_type'] ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Disease/Diagnosis:</strong></td>
                    <td><?= esc($patient['disease']) ?></td>
                </tr>
                <tr>
                    <td><strong>Detailed Diagnosis:</strong></td>
                    <td><?= nl2br(esc($patient['diagnosis'])) ?: 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Assigned Doctor:</strong></td>
                    <td><?= esc($patient['doctor_name']) ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="table-container mb-4">
            <h5 class="mb-4"><i class="bi bi-building me-2"></i>Admission Details</h5>
            <table class="table table-borderless">
                <tr>
                    <td><strong>Status:</strong></td>
                    <td>
                        <span class="badge bg-<?= 
                            $patient['status'] == 'Admitted' ? 'warning' : 
                            ($patient['status'] == 'Discharged' ? 'success' : 'info') 
                        ?>">
                            <?= $patient['status'] ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Admission Date:</strong></td>
                    <td><?= $patient['admission_date'] ? date('d M Y', strtotime($patient['admission_date'])) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Discharge Date:</strong></td>
                    <td><?= $patient['discharge_date'] ? date('d M Y', strtotime($patient['discharge_date'])) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Room Number:</strong></td>
                    <td><?= $patient['room_number'] ?: 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Bed Number:</strong></td>
                    <td><?= $patient['bed_number'] ?: 'N/A' ?></td>
                </tr>
            </table>
        </div>
        
        <div class="table-container">
            <h5 class="mb-4"><i class="bi bi-receipt me-2"></i>Billing Information</h5>
            <div class="text-center">
                <h3 class="text-primary">₹<?= number_format($patient['bill_amount'], 2) ?></h3>
                <p class="text-muted">Total Bill Amount</p>
                <a href="<?= base_url('admin/bills/create') ?>" class="btn btn-primary-custom btn-sm">
                    <i class="bi bi-plus-lg me-2"></i>Generate Bill
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
