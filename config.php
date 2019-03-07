<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'user');
define('MYSQL_PASSWORD', 'password');
define('MYSQL_DATABASE', 'database');
define('TWITTER_USERNAME', 'jpcgfx');
define('SHORT_URL', 'https://bref.pw');
define('DEFAULT_URL', 'https://jeanphilippeguertin.net/');

$dsn = "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD, $options);
} catch (\PDOException $e) {
    die("Could not connect to database.");
}