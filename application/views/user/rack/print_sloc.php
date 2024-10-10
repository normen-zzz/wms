<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print QR Code with Items</title>
    <style>
        @media print {
            @page {
                size: portrait;
            }
        }
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            margin: 0;
        }
        .content {
            display: inline-block;
            text-align: center;
            font-size: 20px;
        }
        h3 {
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="content">
        <h3>SLOC: <?= htmlspecialchars($sloc) ?></h3>
        <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($sloc) ?>&size=300x300" alt="QR Code">
        <table>
            <tr>
                <th>SKU</th>
                <th>Batch</th>
                <th>Total Quantity</th>
            </tr>
            <?php if (!empty($items)) {
                foreach ($items as $item) { ?>
                    <tr>
                        <td><?= htmlspecialchars($item['sku']) ?></td>
                        <td><?= htmlspecialchars($item['batchnumber']) ?></td>
                        <td><?= htmlspecialchars($item['total_quantity']) ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="3">No items found for this SLOC.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
