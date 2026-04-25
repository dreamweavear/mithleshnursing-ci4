<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription - <?= esc($appointment['patient_name']) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Times New Roman', serif; font-size: 13px; color: #000; background: #fff; }

        .page { width: 210mm; min-height: 297mm; margin: 0 auto; padding: 10mm 15mm 10mm 15mm; }

        /* Header */
        .header { border-bottom: 3px double #1a5276; padding-bottom: 8px; margin-bottom: 12px; }
        .clinic-name { font-size: 22px; font-weight: bold; color: #1a5276; letter-spacing: 1px; }
        .clinic-tagline { font-size: 11px; color: #555; margin-top: 2px; }
        .clinic-contact { font-size: 11px; text-align: right; color: #333; }

        /* Patient strip */
        .patient-strip { background: #eaf4fb; border: 1px solid #aed6f1; border-radius: 4px; padding: 8px 12px; margin-bottom: 12px; }
        .patient-strip table { width: 100%; border-collapse: collapse; }
        .patient-strip td { padding: 2px 8px; font-size: 12px; }
        .patient-strip td:first-child { font-weight: bold; width: 100px; }

        /* Vitals */
        .vitals-bar { display: flex; gap: 16px; flex-wrap: wrap; border: 1px solid #d5d8dc; border-radius: 4px; padding: 6px 12px; margin-bottom: 14px; background: #fdfefe; font-size: 12px; }
        .vital-item { display: flex; flex-direction: column; align-items: center; }
        .vital-label { font-size: 10px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; }
        .vital-value { font-weight: bold; font-size: 13px; }

        /* Rx section */
        .rx-label { font-size: 30px; font-weight: bold; color: #1a5276; line-height: 1; margin-bottom: 4px; }
        .section-title { font-size: 12px; font-weight: bold; text-transform: uppercase; color: #1a5276; border-bottom: 1px solid #aed6f1; padding-bottom: 2px; margin: 10px 0 6px 0; letter-spacing: 0.5px; }
        .section-body { font-size: 13px; line-height: 1.7; white-space: pre-wrap; padding-left: 4px; }

        /* Follow-up */
        .followup-box { border: 1px solid #1a5276; border-radius: 4px; padding: 6px 14px; display: inline-block; margin-top: 14px; font-size: 12px; }
        .followup-box strong { color: #1a5276; }

        /* Footer */
        .footer { border-top: 2px solid #1a5276; margin-top: 20px; padding-top: 8px; display: flex; justify-content: space-between; align-items: flex-end; }
        .signature-line { text-align: right; }
        .signature-line hr { width: 160px; margin-bottom: 4px; }
        .signature-line small { font-size: 11px; color: #555; }

@media print {
    body { background: #fff; }
    .page { padding: 8mm 12mm; }
    .no-print { display: none !important; }
    
    /* Footer page ke bilkul neeche fix */
    .footer {
        position: fixed;
        bottom: 10mm;
        left: 12mm;
        right: 12mm;
        border-top: 2px solid #1a5276;
        padding-top: 8px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        background: #fff;
    }
}

        .no-print { text-align: center; margin: 16px 0; }
        .no-print button { padding: 8px 28px; font-size: 14px; background: #1a5276; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
   
   </style>

</head>
<body>
<div class="no-print">
    <button onclick="window.print()">&#128438; Print Prescription</button>
</div>

<div class="page">

    <!-- Header -->
    <div class="header" style="display:flex; justify-content:space-between; align-items:flex-start;">
        <div>
            <div class="clinic-name">MIthlesh Nursing Home</div>
            <div class="clinic-tagline">Quality Healthcare — Compassionate Care</div>
        </div>
        <div class="clinic-contact">
            Ph: +91-9770921099<br>
            Behind Pawar Gas Godown,Allahabad Road, Urrhat, Rewa (M.P.)
        </div>
    </div>

    <!-- Patient Strip -->
    <div class="patient-strip">
        <table>
            <tr>
                <td>Patient</td>
                <td><strong><?= esc($appointment['patient_name']) ?></strong></td>
                <td>Phone</td>
                <td><?= esc($appointment['patient_phone']) ?></td>
                <td>Date</td>
                <td><?= date('d M Y', strtotime($appointment['appointment_date'])) ?></td>
            </tr>
            <tr>
                <td>Doctor</td>
                <td><?= esc($appointment['doctor_name']) ?></td>
                <td>Specialization</td>
                <td colspan="3"><?= esc($appointment['specialization']) ?></td>
            </tr>
        </table>
    </div>

    <!-- Vitals -->
    <?php
    $vitals = [];
    if (!empty($appointment['bp']))          $vitals[] = ['BP', $appointment['bp'] . ' mmHg'];
    if (!empty($appointment['pulse']))       $vitals[] = ['Pulse', $appointment['pulse'] . ' bpm'];
    if (!empty($appointment['spo2']))        $vitals[] = ['SpO2', $appointment['spo2'] . '%'];
    if (!empty($appointment['rr']))          $vitals[] = ['RR', $appointment['rr'] . '/min'];
    if (!empty($appointment['temperature'])) $vitals[] = ['Temp', $appointment['temperature'] . ' °F'];
    if (!empty($appointment['weight']))      $vitals[] = ['Wt', $appointment['weight'] . ' kg'];
    ?>
    <?php if (!empty($vitals)): ?>
    <div class="vitals-bar">
        <?php foreach ($vitals as $v): ?>
        <div class="vital-item">
            <span class="vital-label"><?= $v[0] ?></span>
            <span class="vital-value"><?= $v[1] ?></span>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Chief Complaint & Diagnosis -->
    <?php if (!empty($appointment['chief_complaint'])): ?>
    <div class="section-title">Chief Complaint</div>
    <div class="section-body"><?= nl2br(esc($appointment['chief_complaint'])) ?></div>
    <?php endif; ?>

    <?php if (!empty($appointment['diagnosis'])): ?>
    <div class="section-title">Diagnosis</div>
    <div class="section-body"><?= nl2br(esc($appointment['diagnosis'])) ?></div>
    <?php endif; ?>

    <!-- Rx -->
    <?php if (!empty($appointment['prescription'])): ?>
    <div style="margin-top:12px;">
        <div class="rx-label">&#8478;</div>
        <div class="section-body" style="margin-top:4px;"><?= nl2br(esc($appointment['prescription'])) ?></div>
    </div>
    <?php endif; ?>

    <!-- Advice -->
    <?php if (!empty($appointment['advice'])): ?>
    <div class="section-title">Advice</div>
    <div class="section-body"><?= nl2br(esc($appointment['advice'])) ?></div>
    <?php endif; ?>

    <!-- Follow-up -->
    <?php if (!empty($appointment['followup_date'])): ?>
    <div>
        <div class="followup-box">
            <strong>Follow-up Date:</strong> <?= date('d M Y', strtotime($appointment['followup_date'])) ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer / Signature -->
    <div class="footer">
        <div style="font-size:11px; color:#777;">
            Generated on <?= date('d M Y, h:i A') ?> | Mithlesh Nursing Home
        </div>
        <div class="signature-line">
            <hr>
            <small>Dr. <?= esc($appointment['doctor_name']) ?><br><?= esc($appointment['specialization']) ?></small>
        </div>
    </div>

</div>
</body>
</html>
