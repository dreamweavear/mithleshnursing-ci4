<?php $monthName = date('F', mktime(0,0,0,$month,1)); ?>

<table border="1">

<tr>
<th colspan="2">
Expense Category Report - <?= $monthName ?> <?= $year ?>
</th>
</tr>

<table border="1">
<tr>
    <th colspan="2">
        Expense Category Report
    </th>
</tr>

<tr>
    <th>Category</th>
    <th>Total</th>
</tr>

<?php $grand=0; ?>
<?php foreach($rows as $row): ?>
<?php $grand += $row['total']; ?>

<tr>
    <td><?= $row['category'] ?></td>
    <td><?= number_format($row['total'],2) ?></td>
</tr>

<?php endforeach; ?>

<tr>
    <th>Total</th>
    <th><?= number_format($grand,2) ?></th>
</tr>

</table>