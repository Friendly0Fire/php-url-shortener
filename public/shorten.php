<?php

require '../config.php';

header('Content-Type: text/plain;charset=UTF-8');

if(!isset($_GET['token']))
    die('Token required');
$token = $_GET['token'];

$query = $pdo->prepare("SELECT token FROM auth WHERE token=?");
$query->execute([$token]);
if($query->rowCount() == 0)
    die('Token not found.');

$url = isset($_GET['url']) ? urldecode(trim($_GET['url'])) : '';

if (in_array($url, array('', 'about:blank', 'undefined', 'http://localhost/'))) {
    die('Enter a URL.');
}

if (strpos($url, SHORT_URL) === 0) {
    die($url);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getShortURL()
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM redirect WHERE url=?");
    while(true){
        $url = generateRandomString(5);
        $query->execute([$url]);
        if($query->rowCount() == 0) {
            return $url;
        }
    }
}

$query = $pdo->prepare("SELECT slug FROM redirect WHERE url=?");
$query->execute([$url]);
if ($query->rowCount() > 0) { // If there’s already a short URL for this URL
    $result = $query->fetch();
    die(SHORT_URL . $result['slug']);
} else {
    $slug = getShortURL();
    if(isset($_GET['slug'])) {
        $slug = $_GET['slug'];
    }
    $pdo->prepare('INSERT INTO redirect (slug, url, date, hits) VALUES (?, ?, NOW(), 0)')->execute([$slug, $url]);
    header('HTTP/1.1 201 Created');
    echo SHORT_URL . '/' . $slug;
}
