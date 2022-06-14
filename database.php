<?php
$dsn = 'mysql:dbname=s_557367_db1;host=portfolio.ictcampus.nl';
$user = 'g_holeinone';
$password = 'RK1wka';

try {
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>