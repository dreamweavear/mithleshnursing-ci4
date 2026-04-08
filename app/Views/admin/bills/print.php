<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill #<?= $bill['bill_number'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }
        .bill-header {
            border-bottom: 3px solid #7C3AED;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .bill-title {
            color: #7C3AED;
            font-weight: 700;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-end mb-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Print Bill
            </button>
            <button onclick="window.close()" class="btn btn-secondary ms-2">
                Close
            </button>
        </div>
        
        <div class="bill-header">
            <div class="row">
                <div class="col-8">
                    <h2 class="bill-title mb-2">Mithlesh Nursing Home</h2>
                    <p class="mb-1">Behind Pawar Gas Godown, Allahabad Road, Urrhat,Rewa(M.P.)</p>
                    <p class="mb-1">Phone: +91 9770921099, 7024745594</p>
                    <p class="mb-0">Email: mithleshnursinghome@gmail.com</p>
                </div>
                <div class="col-4 text-end">
                    <h4 class="text-muted">INVOICE</h4>
                    <p class="mb-1"><strong>Bill #:</strong> <?= $bill['bill_number'] ?></p>
                    <p class="mb-0"><strong>Date:</strong> <?= date('d M Y', strtotime($bill['created_at'])) ?></p>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-6">
                <h5 class="mb-3">Patient Information:</h5>
                <p class="mb-1"><strong>Name:</strong> <?= esc($bill['patient_name']) ?></p>
                <p class="mb-1"><strong>Patient ID:</strong> <?= $bill['patient_id'] ?></p>
                <p class="mb-1"><strong>Age:</strong> <?= $bill['age'] ?> years</p>
                <p class="mb-1"><strong>Gender:</strong> <?= $bill['gender'] ?></p>
                <p class="mb-0"><strong>Address:</strong> <?= nl2br(esc($bill['address'])) ?></p>
            </div>
            <div class="col-6 text-end">
                <h5 class="mb-3">Bill Details:</h5>
                <p class="mb-1"><strong>Admission Date:</strong> <?= $bill['admission_date'] ? date('d M Y', strtotime($bill['admission_date'])) : 'N/A' ?></p>
                <p class="mb-1"><strong>Discharge Date:</strong> <?= $bill['discharge_date'] ? date('d M Y', strtotime($bill['discharge_date'])) : 'N/A' ?></p>
                <p class="mb-1"><strong>Payment Status:</strong> <?= $bill['payment_status'] ?></p>
                <?php if ($bill['payment_method']): ?>
                    <p class="mb-0"><strong>Payment Method:</strong> <?= $bill['payment_method'] ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Description</th>
                    <th class="text-end">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Room Charges[&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;] x No of Days[ &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;]</td>
                    <td class="text-end"><?= number_format($bill['room_charges'], 2) ?></td>
                </tr>
                <tr>
                    <td>Doctors Visiting Charges</td>
                    <td class="text-end"><?= number_format($bill['doctor_fees'], 2) ?></td>
                </tr>
                <tr>
                    <td>Medicine Charges</td>
                    <td class="text-end"><?= number_format($bill['medicine_charges'], 2) ?></td>
                </tr>
                <tr>
                    <td>Investigation Charges</td>
                    <td class="text-end"><?= number_format($bill['test_charges'], 2) ?></td>
                </tr>
                <tr>
                    <td>Other Charges ( Surgeon, Aneastheasia, pediatrician, OT charges, Assistance Charges) </td>
                    <td class="text-end"><?= number_format($bill['other_charges'], 2) ?></td> 
                </tr>
            </tbody>
            <tfoot>
                <tr class="table-light">
                    <td class="text-end"><strong>Total Amount</strong></td>
                    <td class="text-end"><strong><?= number_format($bill['total_amount'], 2) ?></strong></td>
                </tr>
                <tr>
                    <td class="text-end">Discount</td>
                    <td class="text-end"><?= number_format($bill['discount'], 2) ?></td>
                </tr>
                <tr class="table-success">
                    <td class="text-end"><strong>Net Amount</strong></td>
                    <td class="text-end"><strong style="font-size: 1.2em;"><?= number_format($bill['net_amount'], 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>
        
        <?php if ($bill['notes']): ?>
            <div class="mt-4">
                <h6>Notes:</h6>
                <p><?= nl2br(esc($bill['notes'])) ?></p>
            </div>
        <?php endif; ?>
        
        <div class="mt-5 pt-4 border-top">
            <div class="row">
                <div class="col-6">
                    <p class="mb-0"><strong>Authorized Signature</strong></p>
                    <p class="text-muted">Mithlesh Nursing Home</p>
                </div>
                <div class="col-6 text-end">
                    <p class="mb-0 text-muted">Thank you for choosing us!</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
