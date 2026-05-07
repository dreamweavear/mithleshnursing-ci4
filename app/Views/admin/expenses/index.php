
<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Expense List</h4>

    <a href="<?= base_url('admin/expenses/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Expense
    </a>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<!-- Filter Box -->
<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form method="get" action="<?= base_url('admin/expenses') ?>">
            <div class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label">From Date</label>
                    <input type="date" name="from" class="form-control"
                           value="<?= esc($_GET['from'] ?? '') ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">To Date</label>
                    <input type="date" name="to" class="form-control"
                           value="<?= esc($_GET['to'] ?? '') ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        <option value="">All</option>

                        <?php
                        $cats = [
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

                        <?php foreach($cats as $cat): ?>
                        <option value="<?= $cat ?>"
                            <?= (($_GET['category'] ?? '') == $cat) ? 'selected' : '' ?>>
                            <?= $cat ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="keyword" class="form-control"
                           placeholder="Paid to / Description"
                           value="<?= esc($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Filter
                    </button>

                    <a href="<?= base_url('admin/expenses') ?>" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>





<div class="card shadow-sm mb-4">
    <div class="card-body">

        <label class="form-label fw-bold mb-3">Quick Filters</label>

        <div class="d-flex flex-wrap gap-2">

            <!-- Today -->
            <a href="<?= base_url('admin/expenses?from='.date('Y-m-d').'&to='.date('Y-m-d')) ?>"
               class="btn btn-success btn-sm">
               Today
            </a>

            <!-- This Month -->
            <a href="<?= base_url('admin/expenses?from='.date('Y-m-01').'&to='.date('Y-m-t')) ?>"
               class="btn btn-primary btn-sm">
               This Month
            </a>

            <!-- Salary -->
            <a href="<?= base_url('admin/expenses?category=Salary') ?>"
               class="btn btn-warning btn-sm">
               Salary
            </a>

            <!-- Medicine -->
            <a href="<?= base_url('admin/expenses?category=Medicine Purchase') ?>"
               class="btn btn-info btn-sm">
               Medicine
            </a>

            <!-- Diesel -->
            <a href="<?= base_url('admin/expenses?category=Diesel') ?>"
               class="btn btn-secondary btn-sm">
               Diesel
            </a>

            <!-- Electricity -->
            <a href="<?= base_url('admin/expenses?category=Electricity') ?>"
               class="btn btn-dark btn-sm">
               Electricity
            </a>

            <!-- Reset -->
            <a href="<?= base_url('admin/expenses') ?>"
               class="btn btn-danger btn-sm">
               Reset
            </a>

        </div>

    </div>
</div>






<!-- Expense Table -->
<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th width="60">#</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Paid To</th>
                    <th>Payment</th>
                    <th width="160">Action</th>
                </tr>
            </thead>

            <tbody>

            <?php if(!empty($expenses)): ?>
                <?php $i=1; $grand=0; ?>

                <?php foreach($expenses as $row): ?>
                <?php $grand += $row['amount']; ?>

                <tr>
                    <td class="text-center"><?= $i++ ?></td>

                    <td><?= date('d-m-Y', strtotime($row['expense_date'])) ?></td>

                    <td><?= esc($row['category']) ?></td>

                    <td><?= esc($row['description']) ?></td>

                    <td class="text-end fw-bold text-danger">
                        ₹<?= number_format($row['amount'],2) ?>
                    </td>

                    <td><?= esc($row['paid_to']) ?></td>

                    <td><?= esc($row['payment_method']) ?></td>

                    <td class="text-center">

                        <a href="<?= base_url('admin/expenses/edit/'.$row['id']) ?>"
                           class="btn btn-sm btn-warning">
                           Edit
                        </a>

                        <a href="<?= base_url('admin/expenses/delete/'.$row['id']) ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this expense?')">
                           Delete
                        </a>

                    </td>
                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="8" class="text-center text-muted">
                        No expenses found.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

            <?php if(!empty($expenses)): ?>
            <tfoot>
                <tr class="table-warning fw-bold">
                    <td colspan="4" class="text-end">Grand Total</td>
                    <td class="text-end">
                        ₹<?= number_format($grand,2) ?>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
            <?php endif; ?>

        </table>

    </div>
</div>

<?= $this->endSection() ?>