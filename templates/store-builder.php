<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['store-item'])) {
        array_push($_SESSION['items'], $_POST['store-item']);
    }
}
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
        <form id="store-builder" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <h3>Shopping List Builder</h3>
        <fieldset>
            <input placeholder="Enter item names" type="text" name="store-item" tabindex="4" required>
        </fieldset>
                <button name="submit" type="submit"  data-submit="...Sending">Add</button>
        </form>

        <h3>Your item</h3>
        <ul class="a">
        <?php
        if(isset($_SESSION['items'])) {
        foreach ($_SESSION['items'] as $item) {
            ?>
            <li><?php echo $item; ?> </li>
            <?php
        }}
        ?>
        </ul>
        <a href="final-page.php">Submit</a>
    </div>
</div>
</body>
</html>