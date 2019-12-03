<?php
include '../DBController.php';
$db_handle = new DBController();
?>
<?php
session_start();
require_once("../DBController.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
  switch ($_GET["action"]) {
    case "add":
      if (!empty($_POST["quantity"])) {
        $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE id='" . $_GET["code"] . "'");
        $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));

        if (!empty($_SESSION["cart_item"])) {
          if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
              if ($productByCode[0]["code"] == $k) {
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
      <img src="../img/logo.png" alt="LOGO">
    </header>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../styleT.css">
  </head>

  <body>

    <ul>
      <li><a href="../index.html">Home</a></li>
      <li class="dropdown">
        <a href="../men.php">Men</a>
        <div class="dropdown-content">
          <a href="../men/new_arrivals.php">New Arrivals</a>
          <a href="../men/casual.php">Casual</a>
          <a href="../men/formal.php">Formal</a>
        </div>
      </li>
      <li class="dropdown">
        <a class="active" href="../women.php">Women</a>
        <div class="dropdown-content">
          <a href="../women/new_arrivals.php">New Arrivals</a>
          <a class="active" href="../women/casual.php">Casual</a>
          <a href="../women/formal.php">Formal</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="../kids.php">Kids</a>
        <div class="dropdown-content">
          <a href="../kids/boys.php">Boys</a>
          <a href="../kids/girls.php">Girls</a>
        </div>
      </li>
      <li><a href="../brands.html">Brands</a></li>
      <li class="dropdown">
        <a href="../about.html">About</a>
        <div class="dropdown-content">
          <a href="../about/locations.html">Store Locations</a>
          <a href="../about.html">Our Story</a>
        </div>
      </li>
      <li><a href="../contact.html">Contact </a></li>
    </ul>

    <SECTION>
      <h1 class="lol" align="center">WOMEN'S CASUAL PRODUCTS</h1>
      <div id="gridview">
        <?php
        $query = $db_handle->runQuery("SELECT * FROM products WHERE target='Women' AND category='Casual' ORDER BY id ASC");
        if (!empty($query)) {
          foreach ($query as $key => $value) {
            ?>
            <div class="image">
              <img src="../<?php echo $query[$key]["image"]; ?>" />
              <form method="post" action="../cart.php?action=add&code=<?php echo $query[$key]["id"]; ?>">
                <div class="product-info">
                  <div class="product-title"><?php echo $query[$key]["name"]; ?></div>
                  <div class="product-category"><?php echo $query[$key]["category"]; ?>
                  </div>
                  <div class="add-to-cart">
                    <div><?php echo $query[$key]["price"]; ?> USD</div>
                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                      <input type="submit" value="Add to Cart" class="btnAddAction" />
                    </div>
                  </div>
              </form>
            </div>

      </div>

  <?php
    }
  }
  ?>
  </div>
    </SECTION>

  </body>
  <footer>
    <p>Contact us:+2547890056 About Us</p>
    <p>All rights reserved ©2019</p>
  </footer>

  </html>>