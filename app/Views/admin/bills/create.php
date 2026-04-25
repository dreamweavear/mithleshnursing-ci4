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
                <label class="form-label">Room Charge (per day) x No. of Days = Total</label>
                <div class="input-group">
                    <input type="number" name="room_rate" id="roomRate" class="form-control" placeholder="Rate" value="0" min="0" step="0.01">
                    <span class="input-group-text">×</span>
                    <input type="number" name="room_days" id="roomDays" class="form-control" placeholder="Days" value="0" min="0" step="1">
                    <span class="input-group-text">=</span>
                    <input type="number" name="room_charges" id="roomChargesTotal" class="form-control charge-input" value="0" min="0" step="0.01" readonly style="background:#f8f9fa; max-width:90px;">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Doctors Visiting Charges</label>
                <input type="number" name="doctor_fees" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Medicine Charges</label>
                <input type="number" name="medicine_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">X-Ray /  C.Arm / Other Investigation Charges</label>
                <input type="number" name="test_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Surgeon Charges</label>
                <input type="number" name="surgery_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Anaesthesia Charges</label>
                <input type="number" name="anaesthesia_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">OT Charges</label>
                <input type="number" name="ot_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Nursing Charges</label>
                <input type="number" name="nursing_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Assistant Charges</label>
                <input type="number" name="assistance_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Plaster POP /Other Charges</label>
                <input type="number" name="other_charges" class="form-control charge-input" value="0" min="0" step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Discount %</label>
                <div class="input-group">
                    <input type="number" name="discount_percent" id="discountPercent" class="form-control" value="0" min="0" max="100" step="0.01">
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Discount Amount</label>
                <input type="number" id="discountAmount" class="form-control" value="0.00" readonly style="background:#f8f9fa;">
            </div>
        </div>

        <!-- Summary Box -->
        <div class="card bg-light mb-4">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="text-muted small mb-1">Subtotal</div>
                        <div class="fs-5 fw-semibold" id="displaySubtotal">₹0.00</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small mb-1">Discount Amount</div>
                        <div class="fs-5 text-danger" id="displayDiscount">- ₹0.00</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small mb-1">Final Total</div>
                        <div class="fs-4 fw-bold text-success" id="displayTotal">₹0.00</div>
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
            <button type="reset" class="btn btn-outline-secondary me-2" id="resetBtn">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Generate Bill</button>
        </div>
    </form>
</div>

<script>
(function () {
    function calcRoomCharges() {
        var rate = parseFloat(document.getElementById('roomRate').value) || 0;
        var days = parseFloat(document.getElementById('roomDays').value) || 0;
        var total = Math.round(rate * days * 100) / 100;
        document.getElementById('roomChargesTotal').value = total.toFixed(2);
        calculateTotals();
    }

    function calculateTotals() {
        var subtotal = 0;
        document.querySelectorAll('.charge-input').forEach(function (el) {
            subtotal += parseFloat(el.value) || 0;
        });

        var discountPct = parseFloat(document.getElementById('discountPercent').value) || 0;
        if (discountPct < 0) discountPct = 0;
        if (discountPct > 100) discountPct = 100;

        var discountAmt = Math.round(subtotal * discountPct / 100 * 100) / 100;
        var finalTotal  = Math.round((subtotal - discountAmt) * 100) / 100;

        document.getElementById('discountAmount').value        = discountAmt.toFixed(2);
        document.getElementById('displaySubtotal').textContent = '₹' + subtotal.toFixed(2);
        document.getElementById('displayDiscount').textContent = '- ₹' + discountAmt.toFixed(2);
        document.getElementById('displayTotal').textContent    = '₹' + finalTotal.toFixed(2);
    }

    document.getElementById('roomRate').addEventListener('input', calcRoomCharges);
    document.getElementById('roomDays').addEventListener('input', calcRoomCharges);

    document.querySelectorAll('.charge-input').forEach(function (el) {
        if (el.id !== 'roomChargesTotal') {
            el.addEventListener('input', calculateTotals);
        }
    });
    document.getElementById('discountPercent').addEventListener('input', calculateTotals);

    document.getElementById('resetBtn').addEventListener('click', function () {
        setTimeout(calculateTotals, 10);
    });

    calculateTotals();
})();
</script>
<?= $this->endSection() ?>
