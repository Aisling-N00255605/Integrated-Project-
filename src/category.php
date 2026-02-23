<?php
require_once "./lib/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Category ID not provided.");
    }
    $categoryId = $_GET["id"];
    $category = Category::findById($categoryId);
    if ($category == null) {
        throw new Exception("Category not found.");
    }
    // $stories = Story::findByCategory($categoryId);
    $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 2));
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>
    <head>
        <title>Stories: <?= $category->name ?></title>
    </head>
    <body>
        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>
        <h1>Stories: <?= $category->name ?></h1>
        <?php foreach ($stories as $s) { ?>
        <div>
            <h2><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a></h2>
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
