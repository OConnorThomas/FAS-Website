<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];

    try {

        require_once 'dbh.php';
        require_once 'signup_model.php';
        require_once 'signup_control.php';

        $query = "INSERT INTO fasusers (firstName, lastName, username, email, pwd) VALUES
            (:firstName, :lastName, :username, :email, :pwd);";

        $stmt = $pdo->prepare($query);
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $hashed_pwd);
        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../../index.php?signup=sucess");
        exit(); // exit safely

    } catch (PDOException $e) {
        die("Login failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
