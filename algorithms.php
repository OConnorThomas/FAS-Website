<?php
require_once 'repo/php/config_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Link to external CSS file -->
  <link rel="stylesheet" type="text/css" href="index.css" />
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

</body>

</html>