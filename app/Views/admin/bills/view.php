<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>View Bill</h4>
    <div>
        <a href="<?= base_url('admin/bills') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
        <a href="<?= base_url('admin/bills/print/' . $bill['id']) ?>" class="btn btn-secondary ms-2" target="_blank">
            <i class="bi bi-printer me-2"></i>Print
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5>Bill #<?= $bill['bill_number'] ?></h5>
                    <p class="text-muted mb-0">Patient: <strong><?= esc($bill['patient_name']) ?></strong> (<?= $bill['patient_id'] ?>)</p>
                </div>
                <span class="badge bg-<?= 
                    $bill['payment_status'] == 'Paid' ? 'success' : 
                    ($bill['payment_status'] == 'Partial' ? 'warning' : 'danger') 
                ?> fs-6">
                    <?= $bill['payment_status'] ?>
                </span>
            </div>
            
            <hr>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Patient Information</h6>
                    <p class="mb-1"><strong>Name:</strong> <?= esc($bill['patient_name']) ?></p>
                    <p class="mb-1"><strong>Age:</strong> <?= $bill['age'] ?> years</p>
                    <p class="mb-1"><strong>Gender:</strong> <?= $bill['gender'] ?></p>
                    <p class="mb-0"><strong>Address:</strong> <?= nl2br(esc($bill['address'])) ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="text-muted">Bill Information</h6>
                    <p class="mb-1"><strong>Bill Date:</strong> <?= date('d M Y', strtotime($bill['created_at'])) ?></p>
                    <p class="mb-1"><strong>Admission:</strong> <?= $bill['admission_date'] ? date('d M Y', strtotime($bill['admission_date'])) : 'N/A' ?></p>
                    <p class="mb-0"><strong>Discharge:</strong> <?= $bill['discharge_date'] ? date('d M Y', strtotime($bill['discharge_date'])) : 'N/A' ?></p>
                </div>
            </div>
            
            <h6 class="text-muted mb-3">Bill Details</h6>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Room Charges [&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;] x No of Days[ &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;]</td>
                        <td class="text-end">₹<?= number_format($bill['room_charges'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Doctors Visiting Fees</td>
                        <td class="text-end">₹<?= number_format($bill['doctor_fees'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Medicine Charges</td>
                        <td class="text-end">₹<?= number_format($bill['medicine_charges'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Investigations Charges</td>
                        <td class="text-end">₹<?= number_format($bill['test_charges'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Other Charges ( Surgeon, Aneastheasia, pediatrician, OT charges, Assistance Charges)</td>
                        <td class="text-end">₹<?= number_format($bill['other_charges'], 2) ?></td>
                    </tr>
                    <tr class="table-light">
                        <td><strong>Total Amount</strong></td>
                        <td class="text-end"><strong>₹<?= number_format($bill['total_amount'], 2) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td class="text-end">₹<?= number_format($bill['discount'], 2) ?></td>
                    </tr>
                    <tr class="table-success">
                        <td><strong>Net Amount</strong></td>
                        <td class="text-end"><strong class="fs-5">₹<?= number_format($bill['net_amount'], 2) ?></strong></td>
                    </tr>
                </tbody>
            </table>
            
            <?php if ($bill['notes']): ?>
                <div class="mt-4">
                    <h6 class="text-muted">Notes</h6>
                    <p class="mb-0"><?= nl2br(esc($bill['notes'])) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="table-container">
            <h6 class="mb-3">Update Payment Status</h6>
            <form action="<?= base_url('admin/bills/update-payment/' . $bill['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-select">
                        <option value="Pending" <?= $bill['payment_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Partial" <?= $bill['payment_status'] == 'Partial' ? 'selected' : '' ?>>Partial</option>
                        <option value="Paid" <?= $bill['payment_status'] == 'Paid' ? 'selected' : '' ?>>Paid</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select">
                        <option value="">Select Method</option>
                        <option value="Cash" <?= $bill['payment_method'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
                        <option value="Card" <?= $bill['payment_method'] == 'Card' ? 'selected' : '' ?>>Card</option>
                        <option value="UPI" <?= $bill['payment_method'] == 'UPI' ? 'selected' : '' ?>>UPI</option>
                        <option value="Bank Transfer" <?= $bill['payment_method'] == 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Update Payment</button>
            </form>
            
            <hr class="my-4">
            
            <div class="text-center">
                <h5 class="text-primary mb-1">₹<?= number_format($bill['net_amount'], 2) ?></h5>
                <small class="text-muted">Total Bill Amount</small>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
