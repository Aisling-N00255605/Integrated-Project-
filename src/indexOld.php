<?php
require_once "./lib/config.php";

try {
    $stories = Story::findAll();
    // $stories = Story::findAll($options = array('limit' => 2));
    // $stories = Story::findAll($options = array('limit' => 2, 'offset' => 2));

    // $authorId = 7;
    // $stories = Story::findByAuthor($authorId);
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3));
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3, 'offset' => 2));

    // $categoryId = 4;
    // $stories = Story::findByCategory($categoryId);
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 2));

    // $locationId = 8;
    // $stories = Story::findByLocation($locationId);
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3));
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3, 'offset' => 2));
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>
    <head>
        <title>Stories</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/grid.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>
        <?php foreach ($stories as $s) { ?>
        <div>
            <h1><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a></h1>
            <h3><?= $s->subheadline ?></h3>
            <div>
                <p><?= $s->article ?></p>
            </div>
            <p><img src="<?= $s->img_url ?>" /></p>
            <?php $author = Author::findById($s->author_id); ?>
            <p>Author: <?= $author->first_name . " " . $author->last_name ?></p>
            <p>Category: <?= Category::findById($s->category_id)->name ?></p>
            <p>Location: <?= Location::findById($s->location_id)->name ?></p>
            <p>Date created: <?= $s->created_at ?></p>
            <p>Last modified: <?= $s->updated_at ?></p>
        </div>
        <?php } ?>
    </body>
</html>
