<?php
require_once "./lib/config.php";
try {
    $wildLifecategoryId = 1;
    $top = Story::findByCategory($wildLifecategoryId, $options = array('limit' => 1, 'offset' => 1));
    $trending = Story::findByCategory($wildLifecategoryId, $options = array('limit' => 4, 'offset' => 1));
    $WildLife = Story::findByCategory($wildLifecategoryId, $options = array('limit' => 4));
    }
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/entertainment.css">



    <title>Newspaper PRACTICE</title>
</head>

<body>

        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>
       
<div>
<div class="container">
<!-- -------------Extra Large Story------------- -->
    
        <?php foreach ($top as $s) { ?>
   <div class="width-8 exLargeBox">
        <div class="imageBox"><img src="<?= $s->img_url ?>" /></div>
        <div class="text">
            <?php $author = Author::findById($s->author_id); ?>
            <p class="author"><?= $author->first_name . " " . $author->last_name ?></p>
            <h1><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline?></a></h1>
        </div>
    </div>
  <?php } ?>
   

<!-- -------------Small Story------------- -->
 <div class="width-4">
        <h4 class="title">Trending</h4>

<div class="smallBox">
   
 <?php foreach ($trending as $s) { ?>
    <div class="story">
        <div class="imageBox"><img src="<?= $s->img_url ?>" /></div>
        <div class="text">
            <?php $author = Author::findById($s->author_id); ?>
            <p class="author"><?= $author->first_name . " " . $author->last_name ?></p>
            <h3><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline?></a></h3>
        </div>
    </div>
  <?php } ?>
 </div>  
</div>
</div>

<!-- -------------Medium Story------------- -->
<div class="container">
<div class="width-12">
        <h4 class="genre">Wildlife</h4>
    </div>

    <?php foreach ($WildLife as $s) { ?>
    <div class="width-3 mediumBox">        
        <div class="imageBox"><img src="<?= $s->img_url ?>" /></div> 
        <div class="text">
            <?php $author = Author::findById($s->author_id); ?>
            <p class="author"><?= $author->first_name . " " . $author->last_name ?></p>
            <h2><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline?></a></h2>
            <p>Fota Wildlife Park announced the birth of two endangered Northern cheetah cubs born to mother Florence and father Nawab. Photograph: Darragh Kane</p>
        </div>
    </div>
    <?php } ?>
</div>
</div>        
</body>

</html>   