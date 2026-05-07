
<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<style>
@media print {

    @page {
        size: landscape;
        margin: 10mm;
    }

    body * {
        visibility: hidden;
    }

    #printArea,
    #printArea * {
        visibility: visible;
    }

    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .main-sidebar,
    .navbar,
    .btn,
    form,
    footer {
        display: none !important;
    }

    table {
        font-size: 12px;
    }

    .print-header {
        text-align: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
    }

    .print-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .print-header p {
        margin: 2px 0;
        font-size: 13px;
    }

    .print-meta {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
        font-size: 13px;
    }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Collection Report</h4>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form method="get" action="<?= base_url('admin/collection') ?>">
            <div class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label">Report Type</label>
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="day" <?= ($type=='day') ? 'selected' : '' ?>>Day Wise</option>
                        <option value="month" <?= ($type=='month') ? 'selected' : '' ?>>Month Wise</option>
                        <option value="year" <?= ($type=='year') ? 'selected' : '' ?>>Year Wise</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">View Report</button>
                    <button type="button" onclick="window.print()" class="btn btn-success">Print</button>

                    <a href="<?= base_url('admin/collection/excel?type='.$type) ?>" class="btn btn-success">
Excel
</a>

<a href="<?= base_url('admin/collection/pdf?type='.$type) ?>" class="btn btn-danger">
PDF
</a>

                </div>

            </div>
        </form>

    </div>
</div>

<div id="printArea">

    <!-- Professional Header -->
    <div class="print-header">
        <h2>ABC NURSING HOME</h2>
        <p>Near Bus Stand, Bhopal, Madhya Pradesh</p>
        <p>Mobile: 9876543210 | Email: info@abcnursinghome.com</p>
    </div>

    <div class="print-meta">
        <div><strong>Report Type:</strong> <?= ucfirst($type) ?> Wise Collection</div>
        <div><strong>Print Date:</strong> <?= date('d-m-Y h:i A') ?></div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Period</th>
                        <th>Room</th>
                        <th>Doctor</th>
                        <th>Medicine</th>
                        <th>Test</th>
                        <th>Surgery</th>
                        <th>Anaesthesia</th>
                        <th>OT</th>
                        <th>Nursing</th>
                        <th>Assistant</th>
                        <th>Other</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $grand = 0;
                foreach($rows as $row):
                    $grand += $row['total'];
                ?>
                    <tr>
                        <td><?= esc($row['period']) ?></td>
                        <td><?= number_format($row['room_charges'],2) ?></td>
                        <td><?= number_format($row['doctor_fees'],2) ?></td>
                        <td><?= number_format($row['medicine_charges'],2) ?></td>
                        <td><?= number_format($row['test_charges'],2) ?></td>
                        <td><?= number_format($row['surgery_charges'],2) ?></td>
                        <td><?= number_format($row['anaesthesia_charges'],2) ?></td>
                        <td><?= number_format($row['ot_charges'],2) ?></td>
                        <td><?= number_format($row['nursing_charges'],2) ?></td>
                        <td><?= number_format($row['assistance_charges'],2) ?></td>
                        <td><?= number_format($row['other_charges'],2) ?></td>
                        <td class="fw-bold text-success"><?= number_format($row['total'],2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr class="table-warning fw-bold">
                        <td colspan="11" class="text-end">Grand Total</td>
                        <td><?= number_format($grand,2) ?></td>
                    </tr>
                </tfoot>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>
