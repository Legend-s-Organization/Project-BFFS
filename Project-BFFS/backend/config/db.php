<?php
/**********************************************************
 * DATABASE CONNECTION (PDO) - UNIVERSITY PERMIT SYSTEM
 **********************************************************/

$host = 'localhost';
$db   = 'university_paws';
$user = 'root';
$pass = ''; // Default XAMPP password is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // In production, you would hide the error message
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
