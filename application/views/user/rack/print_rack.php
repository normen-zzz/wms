<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Rack</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>SLOC: <?= $rack['sloc'] ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $rack['sloc'] ?>" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Zone: <?= $rack['zone'] ?>, Rack: <?= $rack['rack'] ?>, Row: <?= $rack['row'] ?>, Column: <?= $rack['column_rack'] ?></h3>
            </div>
        </div>
    </div>
</body>

</html>