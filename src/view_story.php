<?php
require_once "./lib/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Story ID not provided.");
    }
    $id = $_GET["id"];
    $s = Story::findById($id);
    if ($s == null) {
        throw new Exception("Story not found.");
    }
    $category = Category::findById($s->category_id);
    $related_stories = Story::findByCategory($category->id, $options = array('limit' => 3, 'order_by' => 'updated_at', 'order' => 'DESC'));
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>
    <head>
        <title>Story</title>
    </head>
    <body>
        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>
        <div>
            <h1><?= $s->headline ?></h1>
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
        <div>
            <h2>Related Stories</h2>
            <?php foreach ($related_stories as $rs) { ?>
                <?php if ($rs->id == $s->id) { continue; } ?>
                <div>
                    <h3><a href="view_story.php?id=<?= $rs->id ?>"><?= $rs->headline ?></a></h3>
                    <?php $rs_author = Author::findById($rs->author_id); ?>
                    <p>Author: <?= $rs_author->first_name . " " . $rs_author->last_name ?></p>
                    <!-- <p>Category: <?= Category::findById($rs->category_id)->name ?></p> -->
                    <!-- <p>Location: <?= Location::findById($rs->location_id)->name ?></p> -->
                    <!-- <p>Date created: <?= $rs->created_at ?></p> -->
                    <p>Last modified: <?= $rs->updated_at ?></p>
                </div>
            <?php } ?>
        </div>
    </body>
</html>
