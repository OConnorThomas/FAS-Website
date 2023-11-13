<?php
require_once 'repo/php/config_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Link to external CSS file -->
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="stylesheet" type="text/css" href="contact.css" />
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
  <div class="main">
    <!-- Row One content -->
    <div class="contact-container">
      <div class="column rightB">
        <h3>EunJu Lee</h3>
        <img src="repo/images/EunJu-Headshot.png" alt="User Profile picture" height="150">
        <p class="bio-text">
          Associate Professor at UMass Lowell
          <br>PhD in Finance
          <br>Phone: <a href="tel:(978) 934-2520">(978) 934-2520</a></li>
          <br>Email: <a href="mailto:eunju_lee@uml.edu">EunJu_Lee@uml.edu</a></li>
        </p>
      </div>
      <div class="column rightB">
        <h3>Thomas O'Connor</h3>
        <img src="repo/images/Thomas-Headshot.png" alt="User Profile picture" height="150">

      </div>
      <div class="column">
        <h3>Paul Downen</h3>
        <img src="repo/images/Paul-Headshot.png" alt="User Profile picture" height="150">
        <p class="bio-text">
          Associate Professor at UMass Lowell
          <br>PhD in Computer Science
          <br>Phone: <a href="tel:978-934-3674">(978) 934-3674</a></li>
          <br>Email: <a href="mailto:Paul_Downen@uml.edu">Paul_Downen@uml.edu</a></li>
        </p>
      </div>
    </div>
  </div>
  <!-- Row Two content -->
  <div class="contact-container">
    <div class="column rightB">
      <h3>References:</h3>
      <ul>
        <li><a href="README.md">Reference README</a></li>
        <li>Honors Project 2024: UMass Lowell</li>
        <li>&copy; 2023 FAS. All rights reserved.</li>
      </ul>
    </div>
    <div class="column rightB">
      <h3>Contact:</h3>
      <ul>
        <li>Phone: <a href="tel:(978)-320-5349">(978) 320-5349</a></li>
        <li>Email: <a href="mailto:oconnordthomas@gmail.com">oconnordthomas@gmail.com</a></li>
        <li>Linkedin: <a href="https://www.linkedin.com/in/thomas-o-connor-56285b262/">TOConnor</a></li>
      </ul>
    </div>
    <div class="column">
      <h3>Source Code:</h3>
      <p>
        <a href="https://github.com/Tocslayer/FAS-Website">FAS GitHub Repo</a>
        <br><br>
        Version 1.0.0 | Built with HTML, CSS, PHP
      </p>
    </div>
  </div>
</body>

</html>