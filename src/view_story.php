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

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">

<html>
    <head>
        <title>Story</title>
    </head>
    <body>
        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>
        <div>
            <div class="container">
                <div class="width-4 catLoc">
                    <p class= "category"><?= Category::findById($s->category_id)->name?></p>
                    <p class= "location"><?= Location::findById($s->location_id)->name ?></p>
                </div>
                <div class="width-12">
                    <h1><?= $s->headline ?></h1>
                    <p><?= $s->subheadline ?></p>
                    <p class="viewImg"><img src="<?= $s->img_url ?>" /></p>
                    <p class="shortHeadline"><?= $s->short_headline ?></p>
                    <?php $author = Author::findById($s->author_id); ?>
                    <p class="author">By <?= $author->first_name . " " . $author->last_name ?></p>
                    <p class="published">Published <?= $s->created_at ?></p>
                    <p><?= $s->article ?></p>
                </div>
            </div>
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