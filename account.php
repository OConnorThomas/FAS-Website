<?php
require_once 'repo/php/config_session.php';
require_once 'repo/php/signup_view.php';
require_once 'repo/php/login_view.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Link to external CSS file -->
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="stylesheet" type="text/css" href="account.css" />
  <!-- Metadata -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="Financial, Analysis, Software" />
  <!-- Description / Title / Logo -->
  <meta name="description" content="This program processes historical stock data and 
              suggests an investment using a predictive algorithm." />
  <title>Financial Analysis Software</title>
  <link rel="icon" href="repo/images/FAS Transparent.png" type="FAS Square.png" />
</head>
<!-- Body -->

<body>
  <!-- Header -->
  <div class="header-container">
    <div class="header-background"></div>
    <div class="header-logo">
      <a href="index.php">
        <img src="repo/images/FAS.png" alt="FAS Logo" height="70" />
      </a>
    </div>
    <div class="header-title">
      <a href="index.php">
        <h1>Financial Analysis Software</h1>
      </a>
    </div>
    <a href="account.php" class="account-box"> Account<br />Sign-up | Login </a>
  </div>

  <!-- Navigation bar -->
  <div class="navbar">
    <div class="navbar-box"><a href="index.php">Home</a></div>
    <div class="navbar-box"><a href="analysis.php">Analysis</a></div>
    <div class="navbar-box"><a href="finances.php">Finances</a></div>
    <div class="navbar-box"><a href="algorithms.php">Algorithms</a></div>
    <div class="navbar-box"><a href="contact.php">About/Contact</a></div>
  </div>

  <!-- Page content -->
  <!-- Sign up content -->
  <div class="signup-container">
    <div class="column signup">
      <h2>Sign Up</h2>
      <form action="repo/php/signup.php" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" id="SfirstName" name="firstName" required />
        <label for="lastName">Last Name:</label>
        <input type="text" id="SlastName" name="lastName" required />
        <label for="username">Username:</label>
        <input type="text" id="Susername" name="username" required />
        <label for="email">Email: </label>
        <input type="email" id="Semail" name="email" required />
        <label for="password">Password:</label>
        <input type="password" id="Spassword" name="pwd" required />
        <label for="re-password">Retype Password:</label>
        <input type="password" id="reSpassword" name="reSpassword" required />
        <button type="submit">Sign Up</button>
      </form>
      <div class="error">
        <?php
        check_signup_errors();
        ?>
      </div>
    </div>
    <!-- Log in content -->
    <div class="column">
      <h2>Login</h2>
      <form action="repo/php/login.php" method="post">
        <label for="login-username">Username:</label>
        <input type="text" id="Lusername" name="username" required />
        <label for="login-password">Password:</label>
        <input type="password" id="Lpassword" name="pwd" required />
        <br>
        <button type="submit">Login</button>
      </form>
      <div class="error">
        <?php
        check_login_errors();
        ?>
      </div>
    </div>
  </div>
</body>

</html>