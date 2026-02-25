<?php
require_once "./lib/config.php";
try {
    $top = Story::findAll($options = array('limit' => 1, 'offset' => 1));
     $trending = Story::findAll($options = array('limit' => 4, 'offset' => 4));
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

    <!-- Jost Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Jost Font -->

    <!-- Space Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- Space Mono -->

    <!-- EB Garamond -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
     <!-- EB Garamond -->

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/entertainment.css">
    <link rel="stylesheet" href="css/wildlife.css"> 



    <title>Newspaper PRACTICE</title>
</head>

<body>

        <?php require_once "./lib/navbar.php"; ?>
        <?php require_once "./lib/flash_message.php"; ?>
       

<div class="container">
    <div class="width-12">
        <h1 class="genre">Wildlife</h1>
    </div>
<!-- -------------Extra Large Story------------- -->
    
        <?php foreach ($top as $s) { ?>
   <div class="width-8 exLargeBox">
        <div class="imageBox exlargeImg"><img src="<?= $s->img_url ?>" /></div>
        <div class="text">
            <?php $author = Author::findById($s->author_id); ?>
            <p class="author"><?= $author->first_name . " " . $author->last_name ?></p>
            <h1><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline?></a></h1>
        </div>
    </div>
  <?php } ?>
   

<!-- -------------Small Story------------- -->
<div class="width-4 smallBox">
   
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

<!-- -------------Medium Story------------- -->
<div class="container">
        <!-- ______Box 1______ -->
    <div class="width-3 mediumBox">
        <div class="imageBox mediumImg" style="background-image: url(images/01_Cheetah_Cubs.avif)"></div> 
        <div class="text">
            <p class="author">Jack White</p>
            <h2>New cheetah cubs at Cork’s Fota Wildlife Park a boon to endangered species</h2>
            <p>Fota Wildlife Park announced the birth of two endangered Northern cheetah cubs born to mother Florence and father Nawab. Photograph: Darragh Kane</p>
        </div>
    </div>

    <!-- ______Box 2______ -->
    <div class="width-3 mediumBox">
        <div class="imageBox mediumImg" style="background-image: url(images/02_Domesticated_Fox.webp)"></div> 
        <div class="text">
            <p class="author">Marti Trgovich</p>
            <h2>Gentle foxes approaching humans, seemingly wanting to play, are going viral on TikTok.</h2>
            <p>An urban red fox wanders on top of a brick wall. People who see evidence of “self-domestication” in foxes are confusing it with habituation, experts say.</p>
        </div>
    </div>

    <!-- ______Box 3______ -->
    <div class="width-3 mediumBox">
        <div class="imageBox mediumImg" style="background-image: url(images/29_CBD_Oil.avif)"></div>  
        <div class="text">
            <p class="author">Gennaro Tomma</p>
            <h2>Is CBD good for your dog?</h2>
            <p>CBD has risen in popularity as a treatment for anxiety, inflammation, and pain in dogs. However, scientific evidence supporting the benefits of CBD use for pets is still limited, with most of the studies being preliminary or anecdotal.</p>
        </div>
    </div>

    <!-- ______Box 4______ -->
    <div class="width-3 mediumBox">
        <div class="imageBox mediumImg" style="background-image: url(images/31_Iguanas.avif)"></div>  
        <div class="text">
            <p class="author">Gennaro Tomma</p>
            <h2>Iguanas are falling out of trees in Florida. But here's why you shouldn't try to 'save' them.</h2>
            <p>When temperatures drop, so do the invasive green reptiles. Here’s everything you need to know about cold-stunned iguanas.</p>
        </div>
    </div>
</div>

<!-- -------------Entertainment------------- -->
<div class="film">
    <div class="container">
        <div class="width-12">
            <h1 class="genre">Entertainment</h1>
        </div>
<!-- -------------Small Film Story------------- -->
<div class="width-4 smallFilmBox">
            <h2>More From Entertainment</h2>  
    
    <!-- ______Box 1______ -->
    <div class="story">
        <div class="imageBox smallImg" style="background-image: url(images/04_Kneecap.avif)"></div>  
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h3>Kneecap announce new album Fenian</h3>
        </div>
    </div>

    <!-- ______Box 2______ -->
    <div class="story">
        <div class="imageBox smallImg" style="background-image: url(images/13_Maroon_5.avif)"></div>  
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h3>Maroon 5 to play their first Irish gig in more than 10 years</h3>
        </div>
    </div>

    <!-- ______Box 3______ -->
    <div class="story">
        <div class="imageBox smallImg" style="background-image: url(images/24_Luke_Combs.avif)"></div>  
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h3>Luke Combs: Who is Slane Castle’s next headliner?</h3>
        </div>
    </div>

    <!-- ______Box 4______ -->
    <div class="story">
        <div class="imageBox smallImg" style="background-image: url(images/08_Stephen_King.jpg)"></div>  
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h3>Four new films to see this week: Wicked – For Good, Testimony, Jay Kelly, The Thing With Feathers</h3>
        </div>
    </div>

    <!-- ______Box 5______ -->
    <div class="story">
        <div class="imageBox smallImg" style="background-image: url(images/25_New_Film.avif)"></div>  
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h3>Paul Rudd and Nick Jonas to premiere new film at Dublin International Film Festival</h3>
        </div>
    </div>

    <!-- ______Box 6______ -->
    <div class="story">
        <div class="imageBox smallImg" style="background-image: url(images/05_Peaky_Blinders.jpg)"></div>  
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h3>Cillian Murphy and Barry Keoghan feature in first Peaky Blinders movie teaser trailer</h3>
        </div>
    </div>
</div>
    
<!-- -------------Extra Large Flim Story------------- -->
    <div class="width-1"></div>
    <div class="width-7 exLargeBox">
        <div class="imageBox exlargeImg" style="background-image: url(images/11_Avatar.webp)"></div>
        <div class="text">
            <p class="author">Mark Poynting</p>
            <h1>James Cameron: 'I think this is the riskiest Avatar</h1>
            <p>James Cameron returns with his biggest and longest Avatar adventure to date</p>
        </div>   
    </div>

</div>
</div>
        
</body>

</html>   