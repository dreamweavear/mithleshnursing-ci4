<!DOCTYPE html>
<html>
<head>
<style>
body{font-family: DejaVu Sans;font-size:12px;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #000;padding:6px;}
th{background:#eee;}
</style>
</head>
<body>



<?php $monthName = date('F', mktime(0,0,0,$month,1)); ?>
<h2 align="center">
Expense Category Report - <?= $monthName ?> <?= $year ?>
</h2>

<table>
<tr>
    <th>Category</th>
    <th>Total</th>
</tr>

<?php $grand=0; ?>
<?php foreach($rows as $row): ?>
<?php $grand += $row['total']; ?>

<tr>
    <td><?= $row['category'] ?></td>
    <td align="right"><?= number_format($row['total'],2) ?></td>
</tr>

<?php endforeach; ?>

<tr>
    <th>Total</th>
    <th align="right"><?= number_format($grand,2) ?></th>
</tr>

</table>

</body>
</html>