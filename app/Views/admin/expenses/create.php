<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add Expense</h4>

    <a href="<?= base_url('admin/expenses') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="<?= base_url('admin/expenses/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">

                <!-- Date -->
                <div class="col-md-4">
                    <label class="form-label">Expense Date</label>
                    <input type="date" name="expense_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>

                         <!-- Category -->
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="">Select</option>
                        <option>Medicine Purchase</option>
                        <option>Doctor Visit</option>
                        <option>Anaesthesia</option>
                        <option>Electricity</option>
                        <option>Salary</option>
                        <option>Maintenance</option>
                        <option>Fuel</option>
                        <option>Rent</option>
                        <option>Stationery</option>
                        <option>Other</option>
                    </select>
                </div>

                <!-- Amount -->
                <div class="col-md-4">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" min="0" name="amount" class="form-control" required>
                </div>

                <!-- Paid To -->
                <div class="col-md-4">
                    <label class="form-label">Paid To</label>
                    <input type="text" name="paid_to" class="form-control">
                </div>

                <!-- Payment Method -->
                <div class="col-md-4">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                        <option value="UPI">UPI</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="col-md-4">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>

                <!-- Notes -->
                <div class="col-md-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control"></textarea>
                </div>

                <!-- Buttons -->
                <div class="col-md-12 text-end mt-3">
                    <button type="reset" class="btn btn-outline-secondary">
                        Reset
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Expense
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<?= $this->endSection() ?>
