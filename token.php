<?php

if(!isset($_GET['token']))
    die('Token required');
$token = $_GET['token'];

$query = $pdo->prepare("SELECT token FROM auth WHERE token=?");
$query->execute([$token]);
if($query->rowCount() == 0)
    die('Token not found.');