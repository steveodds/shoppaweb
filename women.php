<?php
include 'DBController.php';
$db_handle = new DBController();
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

  <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">

  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="Men.html">Men</a></li>
    <li><a class="active" href="women.html">Women</a></li>
    <li><a href="Kids.html">Kids</a></li>
    <li><a href="Brands.html">Brands</a></li>
    <li><a href="About.html">About</a></li>
    <li><a href="Contact.html">Contact </a></li>
  </ul>

  <SECTION>
    <h1 class="lol" align="center">NEW WOMEN'S PRODUCTS</h1>

    <!-- <p style="float: left; font-size: 15pt; text-align: center; width: 30%; margin-right: 1%; margin-bottom: 0.5em;">
      <img src="img\womens1.jpg" style="width: 100%">MARY JANE SHOES//BLACK $350.00</p>
    <p style="float: left; font-size: 15pt; text-align: center; width: 30%; margin-right: 1%; margin-bottom: 0.5em;">
      <img src="img\womens2.jpg" style="width: 100%">TWO PART COURT SHOES//BLACK HEATSEAL $23.00</p>
    <p style="float: left; font-size: 15pt; text-align: center; width: 30%; margin-right: 1%; margin-bottom: 0.5em;">
      <img src="img\womens3.jpg" style="width: 100%">CUT-OUT PEEP TOE SHOE BOOTS//BLACK $40.00</p>
    </p>
    <p style="clear: both;">
      <p style="float: left; font-size: 15pt; text-align: center; width: 30%; margin-right: 1%; margin-bottom: 0.5em;">
        <img src="img\womens4.jpg" style="width: 100%">SLINGBACK SHOE BOOTS//BLACK $70.99</p>
      <p style="float: left; font-size: 15pt; text-align: center; width: 30%; margin-right: 1%; margin-bottom: 0.5em;">
        <img src="img\womens5.jpg" style="width: 100%">ASYMMETRIC STRAP BLOCK HEEL SHOES//LEOPARD $500.00</p>
      <p style="float: left; font-size: 15pt; text-align: center; width: 30%; margin-right: 1%; margin-bottom: 0.5em;">
        <img src="img\womens6.jpg" style="width: 100%">TWO PART COURT SHOES//RED $500.00</p>
      <p style="clear: both;"> -->


      <div id="gridview">
        <!-- <div class="heading">Product Gallery for Shopping Cart</div> -->
        <?php
        $query = $db_handle->runQuery("SELECT * FROM products ORDER BY id ASC");
        if (!empty($query)) {
            foreach ($query as $key => $value) {
                ?>
                <div class="image">
                    <img src="<?php echo $query[$key]["image"]; ?>" />
                    <div class="product-info">
                        <div class="product-title"><?php echo $query[$key]["name"]; ?></div>
                        <ul>
                            <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        $selected = "";
                                        if (!empty($query[$key]["average_rating"]) && $i <= $query[$key]["average_rating"]) {
                                            $selected = "selected";
                                        }
                                        ?>
                                <li class='<?php echo $selected; ?>'>★</li>
                            <?php }  ?>
                        </ul>
                        <div class="product-category"><?php echo $query[$key]["category"]; ?>

                        </div>
                        <div class="add-to-cart">
                            <div><?php echo $query[$key]["price"]; ?> USD</div>
                            <div><img src="icon-cart.png" /></div>
                        </div>
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