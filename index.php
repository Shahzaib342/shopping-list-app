<?php
session_start();

if (!isset($_SESSION['items']) && !isset($_SESSION['store-information'])) {
    $store_items = array();
    $_SESSION['items'] = $store_items;

    $store_information = array();
    $_SESSION['store-information'] = $store_information;
}

if (isset($_GET['clear'])) {

    session_unset();
    session_destroy();
}


$storeNameErr = $streetAddressErr = $cityNameErr = $postalCodeErr = "";
$storeName = $streetAddress = $cityName = $postalCode = "";
$flag = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["store-name"])) {
        $storeNameErr = "* Srore Name is required";
        $flag = false;
    } else {
        $storeName = test_input($_POST["store-name"]);

        if (!preg_match("/^[A-Z]*[a-zA-Z0-9 ]*$/", $storeName)) {
            $storeNameErr = "* No special character is required";
            $flag = false;
        } else {
            $flag = true;
            $_SESSION['store-information']['store-name'] = $storeName;
        }
    }

    if (empty($_POST["street-address"])) {
        $streetAddressErr = "* Street Address is required";
        $flag = false;
    } else {
        $streetAddress = test_input($_POST["street-address"]);

        if (!preg_match("/^[0-9]+\s+[A-Z|a-zA-Z]*\s+(rd|st|ave|blvd)[.]\s[N|S|E|W]?$/", $streetAddress)) {
            $streetAddressErr = "* Invalid Street Address format, e.g 25 West st. W";
            $flag = false;
        } else {
            $flag = true;
            $_SESSION['store-information']['street-address'] = $streetAddress;
        }
    }

    if (empty($_POST["city-name"])) {
        $cityName = "";
        $cityNameErr = "* City Name is required";
        $flag = false;
    } else {
        $cityName = test_input($_POST["city-name"]);

        if (!preg_match("/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/", $cityName)) {
            $cityNameErr = "* Invalid city Name integers are not allowed, e.g London";
            $flag = false;
        } else {
            $flag = true;
            $_SESSION['store-information']['city-name'] = $cityName;
        }
    }

    if (empty($_POST["postal-code"])) {
        $postalCodeErr = "* Postal code is required";
        $flag = false;
    } else {
        $postalCode = test_input($_POST["postal-code"]);
        if (!preg_match("/^[A-Za-z]\d[A-Za-z] ?\d[A-Za-z]\d$/", $postalCode)) {
            $postalCodeErr = "* Invalid Postal code format i.e A0A 0A0";
            $flag = false;
        } else {
            $flag = true;
            $_SESSION['store-information']['postal-code'] = $postalCode;
        }
    }

    if ($flag == true) {
        ?>
        <style type="text/css">

            #contact {
                display: none;
            }

            .store-information {
                display: block !important;
            }

        </style>
        <?php
    }

}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container main-page">
    <form id="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Shopping List Builder</h3>
        <h4>Enter the below information to proceed</h4>
        <fieldset>
            <input placeholder="Store Name" type="text" name="store-name" tabindex="1" value="<?php echo $storeName; ?>"
                   required autofocus>
            <span class="error"> <?php echo $storeNameErr; ?></span>
        </fieldset>
        <fieldset>
            <input placeholder="Street Address" type="text" name="street-address" tabindex="2"
                   value="<?php echo $streetAddress; ?>" required>
            <span class="error"><?php echo $streetAddressErr; ?></span>
        </fieldset>
        <fieldset>
            <input placeholder="City Name" type="text" name="city-name" value="<?php echo $cityName; ?>" tabindex="3"
                   required>
            <span class="error"><?php echo $cityNameErr; ?></span>
        </fieldset>
        <fieldset>
            <input placeholder="Postal Code" type="text" name="postal-code" value="<?php echo $postalCode; ?>"
                   tabindex="4" required>
            <span class="error"><?php echo $postalCodeErr; ?></span>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
        <p class="copyright">Designed by <a href="#" target="_blank" title="jachahal">jachahal</a></p>
    </form>
    <div class="store-information">
        <h3>You entered following information</h3>
        <fieldset>
            <label class="store-info-labels">Store Name:</label>
            <label><?php echo $storeName; ?></label>
        </fieldset>
        <fieldset>
            <label class="store-info-labels">Street Address:</label>
            <label><?php echo $streetAddress; ?></label>
        </fieldset>
        <fieldset>
            <label class="store-info-labels">City Name:</label>
            <label><?php echo $cityName; ?></label>
        </fieldset>
        <fieldset>
            <label class="store-info-labels">Postal code:</label>
            <label><?php echo $postalCode; ?></label>
        </fieldset>
        <a class="push" href="templates/store-builder.php">Get Started</a>
    </div>

</div>
</body>
</html>