<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Patient Management</h4>
    <a href="<?= base_url('admin/patients/create') ?>" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-2"></i>Add New Patient
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Age/Gender</th>
                    <th>Type</th>
                    <th>Disease</th>
                    <th>Doctor</th>
                    <th>Room/Bed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($patients)): ?>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><strong><?= esc($patient['patient_id']) ?></strong></td>
                            <td><?= esc($patient['name']) ?></td>
                            <td><?= $patient['age'] ?> / <?= $patient['gender'] ?></td>
                            <td>
                                <span class="badge bg-<?= $patient['patient_type'] == 'IPD' ? 'danger' : 'info' ?>">
                                    <?= $patient['patient_type'] ?>
                                </span>
                            </td>
                            <td><?= esc($patient['disease']) ?></td>
                            <td><?= esc($patient['doctor_name'] ?? 'N/A') ?></td>
                            <td><?= $patient['room_number'] ? 'Room ' . $patient['room_number'] : 'N/A' ?> <?= $patient['bed_number'] ? '/ Bed ' . $patient['bed_number'] : '' ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $patient['status'] == 'Admitted' ? 'warning' : 
                                    ($patient['status'] == 'Discharged' ? 'success' : 'info') 
                                ?>">
                                    <?= $patient['status'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/patients/view/' . $patient['id']) ?>" class="btn btn-sm btn-info me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/patients/edit/' . $patient['id']) ?>" class="btn btn-sm btn-primary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/patients/delete/' . $patient['id']) ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this patient?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-4">No patients found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
