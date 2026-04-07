<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Inquiry Management</h4>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($inquiries)): ?>
                    <?php foreach ($inquiries as $inquiry): ?>
                        <tr class="<?= $inquiry['status'] == 'New' ? 'table-warning' : '' ?>">
                            <td><?= $inquiry['id'] ?></td>
                            <td><?= esc($inquiry['name']) ?></td>
                            <td><?= esc($inquiry['email']) ?></td>
                            <td><?= esc($inquiry['phone']) ?></td>
                            <td><?= character_limiter($inquiry['subject'], 30) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $inquiry['status'] == 'New' ? 'danger' : 
                                    ($inquiry['status'] == 'Read' ? 'warning' : 'success') 
                                ?>">
                                    <?= $inquiry['status'] ?>
                                </span>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($inquiry['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/inquiries/view/' . $inquiry['id']) ?>" class="btn btn-sm btn-info me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/inquiries/delete/' . $inquiry['id']) ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this inquiry?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No inquiries found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
