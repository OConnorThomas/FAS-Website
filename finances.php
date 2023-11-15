<?php
require_once 'repo/php/config_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Link to external CSS files -->
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
        <h3>Example Portfolio:</h3>
        <div class="pie-chart"></div>
        <br>
        <div class="label">&nbspInvestments:</div>
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
        <b>Intro Finances</b>
        <div class="medium-font">
          <p>Track and update your</p>
          <p>investments, all in one place</p>
        </div>
      </div>
    </div>
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Example Investments:</h3>
        <div class="label">
          &nbsp;Tracked:
        </div>
        <br>
        <div class="investments">
          JNJ : $15,000 @ $200/share
          <br>GE : $30,000 @ $100/share
          <br>AMZN : $10,000 @ $28/share
        </div>
        <br>
        <div class="label">
          &nbsp;Previous:
        </div>
        <br>
        <div class="investments">
          WMT : $45,000 @ $50/share
          <br>NVDA @ $500/share
          <br>RCL @ $45/share
          <br>TSLA @ $14,000/share
        </div>
      </div>
    </div>
  <?php } else { ?>
    <!-- Finances content where _LOGGEDIN = true -->
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Current Portfolio:</h3>
        <div class="pie-chart"></div>
        <br>
        <div class="label">
          &nbsp;Investments:
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
        <b>Finances Content</b>
        <div class="medium-font">
          <p>Select an Investment ======></p>
          <p>See metrics and track progress:</p>
          <br>
          <p>Metrics appear below 🤯</p>
        </div>
      </div>
    </div>
    <div class="bounding-box side">
      <div class="main centered">
        <h3>Active Investments:</h3>
        <div class="label">
          &nbsp;Tracked:
        </div>
        <br>
        <div class="investments">
          JNJ : $15,000 @ $200/share
          <br>GE : $30,000 @ $100/share
          <br>AMZN : $10,000 @ $28/share
        </div>
        <br>
        <div class="label">
          &nbsp;Other:
        </div>
        <br>
        <div class="investments">
          WMT : $45,000 @ $50/share
          <br>NVDA @ $500/share
          <br>RCL @ $45/share
          <br>TSLA @ $14,000/share
        </div>
      </div>
    </div>
  <?php } ?>
</body>

</html>