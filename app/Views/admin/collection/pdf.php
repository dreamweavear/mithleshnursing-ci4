<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Collection Report</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
}

h2,h3,p{
    margin:0;
    padding:0;
}

.header{
    text-align:center;
    margin-bottom:10px;
}

.header h2{
    font-size:22px;
}

.header p{
    font-size:12px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

table, th, td{
    border:1px solid #000;
}

th, td{
    padding:5px;
    text-align:center;
}

th{
    background:#eee;
}

.total{
    font-weight:bold;
    background:#f5f5f5;
}
</style>
</head>

<body>

<div class="header">
    <h2><?= esc($settings['site_name'] ?? 'Nursing Home') ?></h2>
    <p><?= ucfirst($type) ?> Wise Collection Report</p>
    <p>Date: <?= date('d-m-Y h:i A') ?></p>
</div>

<table>
<thead>
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

<?php $grand=0; foreach($rows as $row): $grand += $row['total']; ?>

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
    <td><?= number_format($row['total'],2) ?></td>
</tr>

<?php endforeach; ?>

<tr class="total">
    <td colspan="11" align="right">Grand Total</td>
    <td><?= number_format($grand,2) ?></td>
</tr>

</tbody>
</table>

</body>
</html>