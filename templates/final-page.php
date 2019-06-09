<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <div class="store-builder">
        <div>
            <h3>Store Information</h3>
            <fieldset>
                <label class="store-info-labels">Store Name:</label>
                <label><?php echo isset($_SESSION['store-information']['store-name']) ? $_SESSION['store-information']['store-name'] : ''; ?></label>
            </fieldset>
            <fieldset>
                <label class="store-info-labels">Street Address:</label>
                <label><?php echo isset($_SESSION['store-information']['street-address']) ? $_SESSION['store-information']['street-address'] : ''; ?></label>
            </fieldset>
            <fieldset>
                <label class="store-info-labels">City Name:</label>
                <label><?php echo isset($_SESSION['store-information']['city-name']) ? $_SESSION['store-information']['city-name'] : ''; ?></label>
            </fieldset>
            <fieldset>
                <label class="store-info-labels">Postal code:</label>
                <label><?php echo isset($_SESSION['store-information']['postal-code']) ? $_SESSION['store-information']['postal-code'] : ''; ?></label>
            </fieldset>
        </div>

        <h3>Your Store items</h3>
        <ul class="a">
            <?php
            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $item) {
                    ?>
                    <li><?php echo $item; ?> </li>
                    <?php
                }
            }
            ?>
        </ul>
        <a href="../index.php?clear=all" class="back-to-home">Back to home</a>
    </div>
</div>
</body>
</html>