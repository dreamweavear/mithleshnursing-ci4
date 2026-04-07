<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Billing Management</h4>
    <a href="<?= base_url('admin/bills/create') ?>" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-2"></i>Generate Bill
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Bill #</th>
                    <th>Patient</th>
                    <th>Patient ID</th>
                    <th>Total Amount</th>
                    <th>Discount</th>
                    <th>Net Amount</th>
                    <th>Payment Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bills)): ?>
                    <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td><strong><?= $bill['bill_number'] ?></strong></td>
                            <td><?= esc($bill['patient_name']) ?></td>
                            <td><?= $bill['patient_id'] ?></td>
                            <td>₹<?= number_format($bill['total_amount'], 2) ?></td>
                            <td>₹<?= number_format($bill['discount'], 2) ?></td>
                            <td><strong>₹<?= number_format($bill['net_amount'], 2) ?></strong></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $bill['payment_status'] == 'Paid' ? 'success' : 
                                    ($bill['payment_status'] == 'Partial' ? 'warning' : 'danger') 
                                ?>">
                                    <?= $bill['payment_status'] ?>
                                </span>
                            </td>
                            <td><?= date('d M Y', strtotime($bill['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/bills/view/' . $bill['id']) ?>" class="btn btn-sm btn-info me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/bills/print/' . $bill['id']) ?>" class="btn btn-sm btn-secondary me-1" title="Print" target="_blank">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <a href="<?= base_url('admin/bills/delete/' . $bill['id']) ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this bill?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-4">No bills found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
