<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Staff Management</h4>
    <a href="<?= base_url('admin/staff/create') ?>" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-2"></i>Add New Staff
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($staff)): ?>
                    <?php foreach ($staff as $member): ?>
                        <tr>
                            <td><?= $member['id'] ?></td>
                            <td><?= esc($member['name']) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $member['role'] == 'Doctor' ? 'primary' : 
                                    ($member['role'] == 'Nurse' ? 'info' : 
                                    ($member['role'] == 'Receptionist' ? 'warning' : 'secondary')) 
                                ?>">
                                    <?= $member['role'] ?>
                                </span>
                            </td>
                            <td><?= esc($member['phone']) ?></td>
                            <td>₹<?= number_format($member['salary'], 2) ?></td>
                            <td><?= date('d M Y', strtotime($member['joining_date'])) ?></td>
                            <td>
                                <span class="badge bg-<?= $member['status'] == 'Active' ? 'success' : 'danger' ?>">
                                    <?= $member['status'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/staff/edit/' . $member['id']) ?>" class="btn btn-sm btn-primary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/staff/delete/' . $member['id']) ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this staff member?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No staff members found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
