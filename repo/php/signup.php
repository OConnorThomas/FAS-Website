<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $rePassword = $_POST["rePassword"];

    try {
        require_once 'dbh.php';
        require_once 'signup_model.php';
        require_once 'signup_control.php';

        // Error Handlers:
        $errors = [];

        if (is_input_empty($firstName, $lastName, $username, $email, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Did not provide a valid email!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username was taken!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_taken"] = "Email was already registered!";
        }
        if (!do_passwords_match($password, $rePassword)) {
            $errors['password_mismatch'] = "Passwords do not match!";
        }

        require_once 'config_session.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "firstName" => $firstName,
                "lastName" => $lastName,
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../../account.php");
            die();
        }

        create_user($pdo, $firstName, $lastName, $username, $email, $password);
        header("Location: ../../index.php?signup=sucess");

        $pdo = null;
        $stmt = null;
        exit(); // exit safely
    } catch (PDOException $e) {
        die("Login failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
