<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Generate Bill</h4>
    <a href="<?= base_url('admin/bills') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/bills/store') ?>" method="POST" id="billForm">
        <?= csrf_field() ?>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Bill Number</label>
                <input type="text" name="bill_number" class="form-control" value="<?= $billNumber ?>" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Select Patient <span class="text-danger">*</span></label>
                <select name="patient_id" class="form-select" required>
                    <option value="">Choose Patient</option>
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>"><?= esc($patient['name']) ?> (<?= $patient['patient_id'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Admission Date</label>
                <input type="date" name="admission_date" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Discharge Date</label>
                <input type="date" name="discharge_date" class="form-control">
            </div>
        </div>
        
        <h5 class="mb-3">Charges</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Room Charges[  &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;]  x No of Days[ &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;        ] </label>
                <input type="number" name="room_charges" class="form-control charge-input" value="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Doctors Visiting Charges</label>
                <input type="number" name="doctor_fees" class="form-control charge-input" value="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Medicine Charges</label>
                <input type="number" name="medicine_charges" class="form-control charge-input" value="0" step="0.01">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Investigation Charges</label>
                <input type="number" name="test_charges" class="form-control charge-input" value="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Other Charges ( Surgeon, Aneastheasia, pediatrician, OT charges, Assistance Charges)</label>
                <input type="number" name="other_charges" class="form-control charge-input" value="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Discount</label>
                <input type="number" name="discount" class="form-control" value="0" step="0.01">
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Payment Status</label>
                <select name="payment_status" class="form-select">
                    <option value="Pending">Pending</option>
                    <option value="Partial">Partial</option>
                    <option value="Paid">Paid</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-select">
                    <option value="">Select Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="UPI">UPI</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="2"></textarea>
        </div>
        
        <div class="text-end">
            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Generate Bill</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
