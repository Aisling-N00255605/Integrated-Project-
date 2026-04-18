<?php
require_once "../lib/config.php";

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

    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/main.css">

<html>
    <head>
        <title>Story</title>
    </head>
    <body>
        <?php require_once "../lib/navbar_admin.php"; ?>
        <?php require_once "../lib/flash_message.php"; ?>
        <div>
            <div class="container">
                <div class="width-4 catLoc">
                    <p class= "category"><?= Category::findById($s->category_id)->name?></p>
                    <p class= "location"><?= Location::findById($s->location_id)->name ?></p>
                </div>
                <div class="width-12">
                    <h1><?= $s->headline ?></h1>
                    <p><?= $s->subheadline ?></p>
                    <p class="viewImg"><img src="../images/<?= $s->img_url ?>" /></p>
                    <p class="shortHeadline"><?= $s->short_headline ?></p>
                    <?php $author = Author::findById($s->author_id); ?>
                    <p class="author">By <?= $author->first_name . " " . $author->last_name ?></p>
                    <p class="published">Published <?= $s->created_at ?></p>
                    <p><?= $s->article ?></p>

                    <div class="actions">
                        <li><a href="story_edit.php?id=<?= $s->id ?>">Edit</a></li>
                        <li><a href="story_delete.php?id=<?= $s->id ?>">Delete</a></li>
                    </div>
                </div>
            </div>
        </div>

<div class="container">
    <div class="rsStories width-7">
        <h4 class="genre">Related Stories</h4>

        <div class="rsSmallBox">
        <?php foreach ($related_stories as $s) { ?>
    <div class="relatedStories">
        <div class="imageBox"><img src="../images/<?= $s->img_url ?>" /></div> 
        <div class="text">
        <!-- author -->
            <?php $author = Author::findById($s->author_id); ?>
            <p class="author"><?= $author->first_name . " " . $author->last_name ?> <?= Category::findById($s->category_id)->name ?></p>
        <!-- Heading -->
            <h2><a href="/admin/view_storyadmin.php?id=<?= $s->id ?>"><?= $s->headline?></a></h2>
        </div>
    </div>
    <?php } ?>
</div>
</div>
</div>


<?php require_once "../lib/footer_admin.php"; ?>
    </body>
</html>