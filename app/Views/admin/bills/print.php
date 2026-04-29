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
            border-bottom: 3px solid #11998e;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .bill-title {
            color: #11998e;
            font-weight: 700;
        }
        @media print {
            body {
                padding: 0;
                zoom: 80%;
            }
            .no-print {
                display: none !important;
            }
        }

     


    </style>
</head>
<body>
    <div class="container">
        <div id="action-buttons" class="text-end mb-4 no-print">


                <a href="<?= base_url('admin/bills/pdf/' . $bill['id']) ?>" class="btn btn-danger">
                <i class="bi bi-file-pdf"></i> Download PDF
                </a>

         


            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Print Bill
            </button>
            <button onclick="window.close()" class="btn btn-secondary ms-2">
                Close
            </button>
        </div>


            <div class="bill-header">
                <table width="100%" style="margin-bottom:0px;">
                    <tr>
                        <td width="65%" style="vertical-align:top;  padding:2px">
                            <h2 class="bill-title mb-2" style="padding:0px 8px; border:0px solid #dee2e6; text-align:left;" >Mithlesh Nursing Home</h2>
                            <p class="mb-1"> Behind Pawar Gas Godown,Urrht, Allahabad Road,Rewa,(M.P.)</p>
                            <p class="mb-1">Phone: +91 9770921099,7024745594</p>
                            <p class="mb-1">Email: mithleshnursinghome@gmail.com</p>
                        </td>
                        <td width="35%" style="vertical-align:top; text-align:right;">
                            <h4 class="text-muted">INVOICE</h4>
                            <p class="mb-1"><strong>Bill #:</strong> <?= $bill['bill_number'] ?></p>
                            <p class="mb-0"><strong>Date:</strong> <?= date('d M Y', strtotime($bill['created_at'])) ?></p>
                        </td>
                    </tr>
                </table>
            </div>



                    <!-- Patient + Bill Details side by side -->
<table width="100%" style="margin-bottom:15px;">
    <tr>
        <td width="50%" style="vertical-align:top; padding-right:10px;">
             
            <strong>Patient Information:</strong><br>  
            <strong>Name:</strong> <?= esc($bill['patient_name']) ?><br>
            <strong>Patient ID:</strong> <?= $bill['patient_id'] ?><br>
            <strong>Age:</strong> <?= $bill['age'] ?> years<br>
            <strong>Gender:</strong> <?= $bill['gender'] ?><br>
            <strong>Address:</strong> <?= esc($bill['address']) ?>
        </td>
        <td width="50%" style="vertical-align:top; text-align:right;">
             <strong>Bill Details:</strong><br> 
            
            <strong>Admission:</strong> <?= $bill['admission_date'] ? date('d M Y', strtotime($bill['admission_date'])) : 'N/A' ?><br>
            <strong>Discharge:</strong> <?= $bill['discharge_date'] ? date('d M Y', strtotime($bill['discharge_date'])) : 'N/A' ?><br>
            <strong>Payment Status:</strong> <?= $bill['payment_status'] ?>
        </td>
    </tr>
</table>


<table width="100%" style="border-collapse:collapse; margin-bottom:10px;">
    <thead>

          <tr style="background:#d4edda;">
     <!--   <tr style="background:#f8f9fa;">   -->
            <th style="text-align:left; padding:4px 8px; border:1px solid #dee2e6; width:75%;">Description</th>
            <th style="text-align:right; padding:4px 8px; border:1px solid #dee2e6; width:25%;">Amount (₹)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">
                Room Charges
                <?php if (!empty($bill['room_rate']) || !empty($bill['room_days'])): ?>
                    [₹<?= number_format($bill['room_rate'], 2) ?>/day] × [<?= (int)$bill['room_days'] ?> days]
                <?php endif; ?>
            </td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['room_charges'], 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Doctors Visiting Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['doctor_fees'], 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Medicine Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['medicine_charges'], 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Investigation Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['test_charges'], 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Surgeon Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['surgery_charges'] ?? 0, 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Anaesthesia Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['anaesthesia_charges'] ?? 0, 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">OT Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['ot_charges'] ?? 0, 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Nursing Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['nursing_charges'] ?? 0, 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Assistant Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['assistance_charges'] ?? 0, 2) ?></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6;">Other Charges</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><?= number_format($bill['other_charges'], 2) ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr style="background:#f8f9fa;">
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><strong>Subtotal</strong></td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><strong><?= number_format($bill['total_amount'], 2) ?></strong></td>
        </tr>
        <tr>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;">Discount (<?= number_format($bill['discount_percent'] ?? 0, 2) ?>%)</td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;">- <?= number_format($bill['discount'], 2) ?></td>
        </tr>
        <tr style="background:#d4edda;">
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><strong>Final Total</strong></td>
            <td style="padding:5px 8px; border:1px solid #dee2e6; text-align:right;"><strong style="font-size:1.1em;"><?= number_format($bill['net_amount'], 2) ?></strong></td>
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


                <table width="100%" style="margin-bottom:0px;">
                    <tr>
                        <td width="65%" style="vertical-align:top;  padding:2px">
                            
                                <p class="mb-0 compact-text"><strong>Authorized Signature</strong></p>
                                <p class="text-muted compact-text">Mithlesh Nursing Home</p>
                        </td>
                        <td width="35%" style="vertical-align:top; text-align:right;">
                            <p class="mb-0 text-muted compact-text">Thank you for choosing us!</p>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
</body>
</html>
