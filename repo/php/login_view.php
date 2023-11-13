<?php

declare(strict_types=1);

function check_login_errors()
{
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION['errors_login'];
        echo "<br>";
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error;
        }
        echo '</div>';
        unset($_SESSION['errors_login']);
    } else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo "you did it! this is additional text";
    }
}