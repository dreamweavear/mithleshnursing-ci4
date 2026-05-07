
<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Expense</h4>

    <a href="<?= base_url('admin/expenses') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="<?= base_url('admin/expenses/update/'.$expense['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">

                <!-- Expense Date -->
                <div class="col-md-4">
                    <label class="form-label">Expense Date</label>
                    <input type="date"
                           name="expense_date"
                           class="form-control"
                           value="<?= esc($expense['expense_date']) ?>"
                           required>
                </div>

                <!-- Category -->
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <?php
                        $categories = [
                            'Medicine Purchase',
                            'Instrument Purchase',
                            'Doctor Visit',
                            'Anaesthesia',
                            'Electricity',
                            'Salary',
                            'Maintenance',
                            'Diesel',
                            'Petrol',
                            'Rent',
                            'Stationery',
                            'Extra Expenses',
                            'Other'
                        ];
                        ?>

                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($expense['category'] == $cat) ? 'selected' : '' ?>>
                                <?= $cat ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Amount -->
                <div class="col-md-4">
                    <label class="form-label">Amount</label>
                    <input type="number"
                           step="0.01"
                           min="0"
                           name="amount"
                           class="form-control"
                           value="<?= esc($expense['amount']) ?>"
                           required>
                </div>

                <!-- Paid To -->
                <div class="col-md-4">
                    <label class="form-label">Paid To</label>
                    <input type="text"
                           name="paid_to"
                           class="form-control"
                           value="<?= esc($expense['paid_to']) ?>">
                </div>

                <!-- Payment Method -->
                <div class="col-md-4">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select">

                        <option value="Cash" <?= ($expense['payment_method']=='Cash') ? 'selected' : '' ?>>Cash</option>

                        <option value="Card" <?= ($expense['payment_method']=='Card') ? 'selected' : '' ?>>Card</option>

                        <option value="UPI" <?= ($expense['payment_method']=='UPI') ? 'selected' : '' ?>>UPI</option>

                        <option value="Bank Transfer" <?= ($expense['payment_method']=='Bank Transfer') ? 'selected' : '' ?>>Bank Transfer</option>

                    </select>
                </div>

                <!-- Description -->
                <div class="col-md-4">
                    <label class="form-label">Description</label>
                    <input type="text"
                           name="description"
                           class="form-control"
                           value="<?= esc($expense['description']) ?>">
                </div>

                <!-- Notes -->
                <div class="col-md-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes"
                              rows="3"
                              class="form-control"><?= esc($expense['notes']) ?></textarea>
                </div>

                <!-- Buttons -->
                <div class="col-md-12 text-end mt-3">

                    <a href="<?= base_url('admin/expenses') ?>" class="btn btn-outline-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Expense
                    </button>

                </div>

            </div>
        </form>

    </div>
</div>

<?= $this->endSection() ?>
