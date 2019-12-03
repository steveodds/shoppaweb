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
        <li class="dropdown">
            <a href="about.html">About</a>
            <div class="dropdown-content">
                <a href="about/locations.html">Store Locations</a>
                <a href="about.html">Our Story</a>
            </div>
        </li>
        <li><a href="contact.html">Contact </a></li>
    </ul>


    <div class="headerForm">
        <h2>Register</h2>
    </div>

    <form method="post" action="sign_up.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="sign_in.php">Sign in</a>
        </p>
    </form>


</body>
<footer>
    <p>Contact us:+2547890056 About Us</p>
    <p>All rights reserved ©2019</p>
</footer>

</html>