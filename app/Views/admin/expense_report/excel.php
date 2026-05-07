<table border="1">
    <tr>
        <th colspan="2">
            Expense Report (<?= ucfirst($type) ?> Wise)
        </th>
    </tr>

    <tr>
        <th>Period</th>
        <th>Total Expense</th>
    </tr>

    <?php $grand = 0; ?>

    <?php foreach($rows as $row): ?>
    <?php $grand += $row['total']; ?>

    <tr>
        <td><?= $row['period'] ?></td>
        <td><?= number_format($row['total'],2) ?></td>
    </tr>

    <?php endforeach; ?>

    <tr>
        <th>Grand Total</th>
        <th><?= number_format($grand,2) ?></th>
    </tr>
</table>
