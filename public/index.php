<?php

require '../config.php';

if (isset($_GET['slug'])) {

    $slug = $_GET['slug'];

    if ('@' == $slug) {
        $url = 'https://twitter.com/' . TWITTER_USERNAME;
    } else {

        $slug = preg_replace('/[^a-zA-Z0-9]/si', '', $slug);

        $url = DEFAULT_URL . $_SERVER['REQUEST_URI'];
        if (is_numeric($slug) && strlen($slug) > 8) {
            $url = 'https://twitter.com/' . TWITTER_USERNAME . '/status/' . $slug;
        } else {
            $query = $pdo->prepare("SELECT * FROM redirect WHERE slug=?");
            $query->execute([$slug]);
            $details = $query->fetch();

            if ($query->rowCount() > 0) {
                $hitquery = $pdo->prepare("UPDATE redirect SET hits = hits + 1 WHERE slug=?");
                $hitquery->execute([$slug]);
                $url = $details['url'];
            }
        }
    }
}