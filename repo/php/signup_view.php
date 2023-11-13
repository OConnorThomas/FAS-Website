<?php

declare(strict_types=1);

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];
        echo "<br>";
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error;
        }
        echo '</div>';
        unset($_SESSION['errors_signup']);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "you did it! this is additional text";
    }
}