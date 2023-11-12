<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["pwd"];

    try {

        require_once 'dbh.php';
        require_once 'login_model.php';
        require_once 'login_control.php';

        // Error Handlers:
        $errors = [];

        if (is_input_empty($username, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);
        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        if (!is_username_wrong($result) && is_password_wrong($password, $result["password"])) {
        }

        require_once 'config_session.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../../index.php?login=sucess");
        $pdo = null;
        $stmt = null;
        exit(); // Ensure that no other code is executed after the redirect

    } catch (PDOException $e) {
        die("Login failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
