<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<style>
@media print {

    aside,
    .main-sidebar,
    .sidebar,
    .navbar,
    .main-header,
    .btn,
    form,
    .no-print,
    footer {
        display:none !important;
    }

    .content-wrapper,
    .content,
    .card,
    .card-body,
    .container-fluid {
        margin:0 !important;
        padding:0 !important;
        width:100% !important;
    }

    body {
        margin:0 !important;
        padding:0 !important;
    }

    table {
        font-size:12px;
        width:100%;
    }

    h4 {
        text-align:center;
        margin-bottom:20px;
    }

    @page {
        size: A4 landscape;
        margin:10mm;
    }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Expense Report</h4>
</div>

<!-- Filter -->
<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form method="get" action="<?= base_url('admin/expense-report') ?>">
            <div class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label">Report Type</label>

                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="day" <?= ($type=='day') ? 'selected' : '' ?>>Day Wise</option>
                        <option value="month" <?= ($type=='month') ? 'selected' : '' ?>>Month Wise</option>
                        <option value="year" <?= ($type=='year') ? 'selected' : '' ?>>Year Wise</option>
                    </select>
                </div>

                <div class="col-md-9">
                    <div class="d-flex flex-wrap gap-2">

                        <button type="submit" class="btn btn-primary">
                            View Report
                        </button>

                        <button type="button" onclick="window.print()" class="btn btn-success">
                            Print
                        </button>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

<!-- Table -->
<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th width="200">Period</th>
                    <th>Total Expense</th>
                </tr>
            </thead>

            <tbody>

            <?php if(!empty($rows)): ?>
                <?php $grand = 0; ?>

                <?php foreach($rows as $row): ?>
                <?php $grand += $row['total']; ?>

                <tr>
                    <td><?= esc($row['period']) ?></td>

                    <td class="text-end fw-bold text-danger">
                        ₹<?= number_format($row['total'],2) ?>
                    </td>
                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="2" class="text-center text-muted">
                        No report data found.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

            <?php if(!empty($rows)): ?>
            <tfoot>
                <tr class="table-warning fw-bold">
                    <td class="text-end">Grand Total</td>

                    <td class="text-end">
                        ₹<?= number_format($grand,2) ?>
                    </td>
                </tr>
            </tfoot>
            <?php endif; ?>

        </table>

    </div>
</div>

<?= $this->endSection() ?>
