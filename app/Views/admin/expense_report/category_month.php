<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<?php
$monthName = date('F', mktime(0,0,0,$month,1));
?>

<style>
@media print{

    .no-print,
    .btn,
    aside,
    nav,
    footer,
    .sidebar,
    .main-sidebar,
    .navbar{
        display:none !important;
    }

    body{
        margin:0;
        padding:0;
    }

    .card{
        border:none;
        box-shadow:none;
    }

}
</style>

<div class="container-fluid">



<!-- Top Report Header Section -->
<div class="card shadow-sm border-0 rounded-4 mb-4 no-print">
    <div class="card-body p-4">

        <!-- Title -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>
                    Expense Category Report
                </h3>

                <p class="text-muted mb-0">
                    <?= $monthName ?> <?= $year ?>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mt-3 mt-lg-0 d-flex flex-wrap gap-2">

                <a href="<?= base_url('admin/expense-report/category-month-excel?month='.$month.'&year='.$year.'&category='.$category) ?>"
                   class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    Excel
                </a>

                <a href="<?= base_url('admin/expense-report/category-month-pdf?month='.$month.'&year='.$year.'&category='.$category) ?>"
                   class="btn btn-danger rounded-pill px-4">
                    <i class="bi bi-file-earmark-pdf me-1"></i>
                    PDF
                </a>

                <button onclick="window.print()" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-printer me-1"></i>
                    Print
                </button>

            </div>
        </div>


        <!-- Filter Form -->
        <form method="get" class="row g-3 align-items-end">

            <!-- Month -->
            <div class="col-md-3">
                <label class="form-label fw-semibold text-muted">Month</label>

                <select name="month" class="form-select rounded-3">
                    <?php for($m=1;$m<=12;$m++): ?>
                    <option value="<?= $m ?>" <?= ($month==$m)?'selected':'' ?>>
                        <?= date('F', mktime(0,0,0,$m,1)) ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Year -->
            <div class="col-md-2">
                <label class="form-label fw-semibold text-muted">Year</label>

                <select name="year" class="form-select rounded-3">
                    <?php for($y=2024;$y<=2030;$y++): ?>
                    <option value="<?= $y ?>" <?= ($year==$y)?'selected':'' ?>>
                        <?= $y ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Category -->
            <div class="col-md-4">
                <label class="form-label fw-semibold text-muted">Category</label>

                <select name="category" class="form-select rounded-3">
                    <option value="">All Category</option>

                    <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat['category'] ?>"
                        <?= ($category==$cat['category'])?'selected':'' ?>>
                        <?= $cat['category'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Submit -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-dark w-100 rounded-3">
                    <i class="bi bi-search me-1"></i>
                    View Report
                </button>
            </div>

        </form>

    </div>
</div>



<div class="card">
<div class="card-body">
<!--
<h3 class="text-center mb-4">
Expense Category Report - <?= $monthName ?> <?= $year ?>
</h3>
-->

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
    <th width="60%">Category</th>
    <th width="40%">Amount</th>
</tr>
</thead>

<tbody>

<?php $grand=0; ?>
<?php foreach($rows as $row): ?>
<?php $grand += $row['total']; ?>

<tr>
    <td><?= esc($row['category']) ?></td>
    <td class="text-end text-danger fw-bold">
        ₹<?= number_format($row['total'],2) ?>
    </td>
</tr>

<?php endforeach; ?>

</tbody>

<tfoot>
<tr class="table-warning fw-bold">
    <td>Total Expense</td>
    <td class="text-end">
        ₹<?= number_format($grand,2) ?>
    </td>
</tr>
</tfoot>

</table>

</div>
</div>

</div>

<?= $this->endSection() ?>