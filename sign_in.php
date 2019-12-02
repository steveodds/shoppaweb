<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <header>
        <img src="img\logo.png" alt="LOGO">
    </header>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="men.html">Men</a></li>
        <li><a href="women.php">Women</a></li>
        <li><a href="kids.html">Kids</a></li>
        <li><a href="brands.html">Brands</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact </a></li>
    </ul>


    <div class="headerForm">
        <h2>Login</h2>
    </div>

    <form method="post" action="sign_in.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="sign_up.php">Sign up</a>
        </p>
    </form>



</body>
<footer>
    <p>Contact us:+2547890056 About Us</p>
    <p>All rights reserved ©2019</p>
</footer>

</html>