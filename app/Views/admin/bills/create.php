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
            <div class="col-md-3 mb-3">
                <label class="form-label">Room Charge per Day (₹)</label>
                <input type="number" name="room_charge_per_day" id="room_charge_per_day" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">No of Days</label>
                <input type="number" name="no_of_days" id="no_of_days" class="form-control charge-input" value="0" step="1" min="0">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Room Charges Total (₹)</label>
                <input type="number" id="room_charges_display" class="form-control bg-light" value="0" step="0.01" readonly>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Doctors Visiting Charges (₹)</label>
                <input type="number" name="doctor_fees" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Medicine Charges (₹)</label>
                <input type="number" name="medicine_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Investigation Charges (₹)</label>
                <input type="number" name="test_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Surgery Charges (₹)</label>
                <input type="number" name="surgery_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Anaesthesia Charges (₹)</label>
                <input type="number" name="anaesthesia_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">OT Charges (₹)</label>
                <input type="number" name="ot_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Nursing Charges (₹)</label>
                <input type="number" name="nursing_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Assistance Charges (₹)</label>
                <input type="number" name="assistance_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Other Charges (₹)</label>
                <input type="number" name="other_charges" class="form-control charge-input" value="0" step="0.01" min="0">
            </div>
        </div>

        <!-- Summary Section -->
        <div class="card bg-light mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold">Subtotal:</span>
                            <span id="subtotal_display" class="fw-semibold">₹0.00</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row g-2 align-items-center">
                            <div class="col-5">
                                <label class="form-label mb-0">Discount %</label>
                                <input type="number" name="discount_percent" id="discount_percent" class="form-control form-control-sm" value="0" step="0.01" min="0" max="100">
                            </div>
                            <div class="col-7">
                                <label class="form-label mb-0">Discount Amount (₹)</label>
                                <input type="number" id="discount_amount_display" class="form-control form-control-sm bg-light" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5">Final Total:</span>
                            <span id="final_total_display" class="fw-bold fs-5 text-success">₹0.00</span>
                        </div>
                    </div>
                </div>
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
            <button type="reset" class="btn btn-outline-secondary me-2" onclick="resetCalculations()">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Generate Bill</button>
        </div>
    </form>
</div>

<script>
function calculateBill() {
    var perDay  = parseFloat(document.getElementById('room_charge_per_day').value) || 0;
    var days    = parseInt(document.getElementById('no_of_days').value) || 0;
    var roomTotal = perDay * days;
    document.getElementById('room_charges_display').value = roomTotal.toFixed(2);

    var chargeInputs = document.querySelectorAll('.charge-input');
    var subtotal = 0;
    chargeInputs.forEach(function(input) {
        if (input.name !== 'room_charge_per_day' && input.name !== 'no_of_days') {
            subtotal += parseFloat(input.value) || 0;
        }
    });
    subtotal += roomTotal;

    var discountPct = parseFloat(document.getElementById('discount_percent').value) || 0;
    if (discountPct < 0) discountPct = 0;
    if (discountPct > 100) discountPct = 100;
    var discountAmt = Math.round(subtotal * discountPct / 100 * 100) / 100;
    var finalTotal  = subtotal - discountAmt;

    document.getElementById('subtotal_display').textContent       = '₹' + subtotal.toFixed(2);
    document.getElementById('discount_amount_display').value      = discountAmt.toFixed(2);
    document.getElementById('final_total_display').textContent    = '₹' + finalTotal.toFixed(2);
}

function resetCalculations() {
    setTimeout(function() {
        document.getElementById('room_charges_display').value     = '0.00';
        document.getElementById('subtotal_display').textContent   = '₹0.00';
        document.getElementById('discount_amount_display').value  = '0.00';
        document.getElementById('final_total_display').textContent = '₹0.00';
    }, 10);
}

document.querySelectorAll('.charge-input').forEach(function(input) {
    input.addEventListener('input', calculateBill);
});
document.getElementById('discount_percent').addEventListener('input', calculateBill);
</script>
<?= $this->endSection() ?>
