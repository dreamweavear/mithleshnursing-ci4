
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Expense Report</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
}

h2{
    text-align:center;
    margin-bottom:5px;
}

p{
    text-align:center;
    margin-top:0;
    margin-bottom:15px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    border:1px solid #000;
    padding:6px;
}

th{
    background:#eee;
}

.text-right{
    text-align:right;
}

.footer-total{
    font-weight:bold;
    background:#f5f5f5;
}
</style>

</head>
<body>

<h2>Expense Report</h2>
<p><?= ucfirst($type) ?> Wise</p>

<table>
    <tr>
        <th width="50%">Period</th>
        <th width="50%">Total Expense</th>
    </tr>

    <?php $grand = 0; ?>

    <?php foreach($rows as $row): ?>
    <?php $grand += $row['total']; ?>

    <tr>
        <td><?= $row['period'] ?></td>
        <td class="text-right">
            <?= number_format($row['total'],2) ?>
        </td>
    </tr>

    <?php endforeach; ?>

    <tr class="footer-total">
        <td class="text-right">Grand Total</td>
        <td class="text-right">
            <?= number_format($grand,2) ?>
        </td>
    </tr>

</table>

</body>
</html>