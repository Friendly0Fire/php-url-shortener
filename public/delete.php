<?php

require '../config.php';
require '../token.php';

header('Content-Type: text/plain;charset=UTF-8');

$url = isset($_GET['url']) ? urldecode(trim($_GET['url'])) : '';
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if($url == '' && $slug == '')
    die('Enter a URL or slug.');
if($url != '' && $slug != '')
    die('Enter either a URL or a slug.');

if($url != '') {
    $query = $pdo->prepare("DELETE FROM redirect WHERE url=?");
    $query->execute([$url]);
    die('Entries affected: ' . $query->rowCount());
}
