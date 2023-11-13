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
    <a href="account.php" class="account-box"> Account<br />
      <?php
      if (!isset($_SESSION['_LOGGEDIN']) || !$_SESSION['_LOGGEDIN'])
        $accountDescription = "Sign-up | Login";
      else
        $accountDescription = $_SESSION["user_username"];
      echo $accountDescription;
      ?>
    </a>
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
  <?php if (!isset($_SESSION['_LOGGEDIN']) || !$_SESSION['_LOGGEDIN']) { ?>
    <div class="account-container">
      <div class="column left">
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
          <input type="password" id="reSpassword" name="rePassword" required />
          <button type="submit">Sign Up</button>
        </form>
        <?php
        check_signup_errors();
        ?>
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
        <?php
        check_login_errors();
        ?>
      </div>
    </div>
  <?php } else { ?>
    <!-- Current Account content -->
    <div class="account-container">
      <div class="column left">
        <div class="profile-pic">
          <img src="repo/images/Generic-Profile-Image.png" alt="User Profile picture" height="150">
          <!-- TODO Link to new table to change profile pic -->
        </div>
        <div class="profile-header">
          <h2>
            <?php echo $_SESSION["user_firstName"] . "'s " ?>
            Profile:
          </h2>
          <h3>
            <?php echo $accountDescription; ?>
          </h3>
        </div>
      </div>
      <!-- Log out content -->
      <div class="column">
        <h2>Logout</h2>
        <form action="repo/php/logout.php" method="post">
          <button type="submit">Logout</button>
        </form>
      </div>
    </div>
  <?php } ?>
</body>

</html>