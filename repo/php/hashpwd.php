<?php

$pwd = "12345";

$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

if (password_verify($pwd, $hashed_pwd)) {
    
} else {

}