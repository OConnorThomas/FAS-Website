<?php
require_once 'repo/php/config_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Link to external CSS file -->
  <link rel="stylesheet" type="text/css" href="index.css" />
  <link rel="stylesheet" type="text/css" href="finances.css" />
  <!-- Link to external JS file -->
  <script src="repo/js/finances.js"></script>
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
  <!-- Intro content where _LOGGEDIN = false -->
  <?php if (!isset($_SESSION['_LOGGEDIN']) || !$_SESSION['_LOGGEDIN']) { ?>
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Features:</h3>
      </div>
    </div>
    <div class="bounding-box middle">
      <div class="main large-font centered">
        <b>Welcome to FAS!</b>
        <div class="medium-font">
          <p>Create an account and answer</p>
          <p>a few short questions so</p>
          <p>we can start making</p>
          <p>tailored investment</p>
          <p>recommendations.</p>
        </div>
      </div>
      <div class="button-container">
        <a href="account.php">
          <button type="button">Sign Up</button>
        </a>
        <a href="account.php">
          <button type="button">Login</button>
        </a>
      </div>
    </div>
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Examples:</h3>
      </div>
    </div>
  <?php } else { ?>
    <!-- Main Dashboard content where _LOGGEDIN = true -->
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Current Portfolio:</h3>
        <div class="pie-chart"></div>
        <br>
        <div class="label">
          &nbspInvestments:
        </div>
        <br>
        <div class="investments">
          JNJ : $15,000
          <br>GE : $30,000
          <br>AMZN : $10,000
          <br>WMT : $45,000
        </div>
      </div>
    </div>
    <div class="bounding-box middle">
      <div class="main large-font centered">
        <b>Welcome to the Dashboard!</b>
        <div class="medium-font">
          <p>You're logged in</p>
          <p>I'm literally so proud 💅</p>
          <br>
          <p>Tracked stocks go here</p>
        </div>
      </div>
    </div>
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Suggested Investments:</h3>
      </div>
    </div>
  <?php } ?>
</body>

</html>