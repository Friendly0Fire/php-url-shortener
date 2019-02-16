<?php

require 'config.php';

$url = DEFAULT_URL . '/';

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
            $query = $pdo->query("SELECT * FROM redirect=?");
            $query->execute([$slug]);
            $details = $query->fetch();

            if ($query->rowCount() > 0) {
                $hitquery = $pdo->query("UPDATE redirect SET hits = hits + 1 WHERE slug=?");
                $hitquery->execute([$slug]);
                $url = $details['url'];
            }
        }
    }
}

header('Location: ' . $url, null, 301);

$attributeValue = htmlspecialchars($url);
?>
<meta http-equiv=refresh content="0;URL=<?php echo $attributeValue; ?>"><a href="<?php echo $attributeValue; ?>">Continue</a>
<script>location.href =<?php echo json_encode($url, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES); ?></script>
