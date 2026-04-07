<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Doctor Management</h4>
    <a href="<?= base_url('admin/doctors/create') ?>" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-2"></i>Add New Doctor
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Experience</th>
                    <th>Phone</th>
                    <th>Availability</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($doctors)): ?>
                    <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?= $doctor['id'] ?></td>
                            <td><?= esc($doctor['name']) ?></td>
                            <td><?= esc($doctor['specialization']) ?></td>
                            <td><?= $doctor['experience'] ?: 'N/A' ?></td>
                            <td><?= esc($doctor['phone']) ?></td>
                            <td><?= $doctor['availability_time'] ?: 'Mon-Sat: 9AM-6PM' ?></td>
                            <td>
                                <span class="badge bg-<?= $doctor['status'] == 'active' ? 'success' : 'secondary' ?>">
                                    <?= ucfirst($doctor['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/doctors/edit/' . $doctor['id']) ?>" class="btn btn-sm btn-primary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/doctors/delete/' . $doctor['id']) ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this doctor?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No doctors found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
