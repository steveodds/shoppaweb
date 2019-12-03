<?php
session_start();
require_once("DBController.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE id='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["id"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <header>
            <img src="img\logo.png" alt="LOGO">
        </header>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="styleT.css">
    </head>

    <body>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li class="dropdown">
                <a href="about.html">About</a>
                <div class="dropdown-content">
                    <a href="about/locations.html">Store Locations</a>
                    <a href="about.html">Our Story</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="men.php">Men</a>
                <div class="dropdown-content">
                    <a href="men/new_arrivals.php">New Arrivals</a>
                    <a href="men/casual.php">Casual</a>
                    <a href="men/formal.php">Formal</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="women.php">Women</a>
                <div class="dropdown-content">
                    <a href="women/new_arrivals.php">New Arrivals</a>
                    <a href="women/casual.php">Casual</a>
                    <a href="women/formal.php">Formal</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="kids.php">Kids</a>
                <div class="dropdown-content">
                    <a href="kids/boys.php">Boys</a>
                    <a href="kids/girls.php">Girls</a>
                </div>
            </li>
            <li><a href="brands.html">Brands</a></li>
            <li><a href="contact.html">Contact </a></li>
            <li class="cart-button">
                <a href="cart.php">
                    <img src="img/icon-cart.png" class="cart-T-image">
                </a>
            </li>
        </ul>
        <div id="shopping-cart">
            <div class="txt-heading"><?php echo $_SESSION['username']; ?>'s Order</div>
            <a id="btnCheckout" href="order.php">PAY</a>
            <?php
            if (isset($_SESSION["cart_item"])) {
                $total_quantity = 0;
                $total_price = 0;
                ?>
                <table class="tbl-cart" cellpadding="10" cellspacing="1">
                    <tbody>
                        <tr>
                            <th style="text-align:left;">Name</th>
                            <th style="text-align:left;">Code</th>
                            <th style="text-align:right;" width="5%">Quantity</th>
                            <th style="text-align:right;" width="10%">Unit Price</th>
                            <th style="text-align:right;" width="10%">Price</th>
                        </tr>
                        <?php
                            foreach ($_SESSION["cart_item"] as $item) {
                                $item_price = $item["quantity"] * $item["price"];
                                ?>
                            <tr>
                                <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["code"]; ?></td>
                                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                <td style="text-align:right;"><?php echo "$ " . $item["price"]; ?></td>
                                <td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
                            </tr>
                        <?php
                                $total_quantity += $item["quantity"];
                                $total_price += ($item["price"] * $item["quantity"]);
                            }
                            ?>

                        <tr>
                            <td colspan="2" align="right">Total Due:</td>
                            <td align="right"><?php echo $total_quantity; ?></td>
                            <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            <?php
            } else {
                ?>
                <div class="no-records">You have no items in your order. Browse the product sections and add items to your cart.</div>
            <?php
            }
            ?>
        </div>
    </body>
    <footer>
        <p>Contact us:+2547890056 About Us</p>
        <p>All rights reserved ©2019</p>
    </footer>

    </html>