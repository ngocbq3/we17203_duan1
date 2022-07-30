<?php

try {
    $conn = new PDO("mysql:host=127.0.0.1; dbname=php1_we17202; charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    throw $e;
}

function checkEmail($email)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
