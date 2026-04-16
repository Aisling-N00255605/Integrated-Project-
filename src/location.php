<?php
require_once "./lib/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Location ID not provided.");
    }
    $location_id = $_GET["id"];
    $location = Location::findById($location_id);
    if ($location == null) {
        throw new Exception("Location not found.");
    }
    // $stories = Story::findByCategory($categoryId);
    $stories = Story::findByLocation($location_id);
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
    <link rel="stylesheet" href="css/main.css">

<html>
    <head>
        <title><?= $location->name ?></title>
    </head>
    <body>
        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>

<div class="container">
    <div class="width-12">
        <h4 class="genre"><?= $location->name ?></h4>
    </div>

    <?php foreach ($stories as $s) { ?>
    <div class="width-3 mediumBox">
        <div class="imageBox"><img src="images/<?= $s->img_url ?>" /></div> 
        <div class="text">
            <div class="toplocation">
        <!-- author -->
                <?php $author = Author::findById($s->author_id); ?>
                <p class="locationfilter"><?= $author->first_name . " " . $author->last_name ?> <?= Category::findById($s->category_id)->name ?></p>        
        <!-- location --> 
                <p class="locationfilter"><?= Location::findById($s->location_id)->name ?></p>
            </div>
        <!-- Heading -->
            <h2><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline?></a></h2>
        <!-- pargraph -->
            <p><?= $s->subheadline ?></p>
        </div>
    </div>
    <?php } ?>
</div>

<?php require_once "./lib/footer.php"; ?>
    </body>
</html>
