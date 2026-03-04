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
    $stories = Story::findByCategory($categoryId, $options = array('limit' => 12));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 2));
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/entertainment.css">

<html>
    <head>

        <title><?= $category->name ?></title>
    </head>
    <body>
        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>

<div class="container">
    <div class="width-12">
        <h4 class="genre"><?= $category->name ?></h4>
    </div>

    <?php foreach ($stories as $s) { ?>
    <div class="width-3 categoryBox">
        <div class="imageBox"><img src="<?= $s->img_url ?>" /></div> 
        <div class="text">
        <!-- author -->
            <?php $author = Author::findById($s->author_id); ?>
            <p class="author"><?= $author->first_name . " " . $author->last_name ?> <?= Category::findById($s->category_id)->name ?></p>
        <!-- Heading -->
            <h2><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline?></a></h2>
        <!-- pargraph -->
            <p><?= $s->subheadline ?></p>
        </div>
    </div>
    <?php } ?>
</div>
    </body>
</html>
