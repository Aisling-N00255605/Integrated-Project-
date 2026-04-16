<?php

try {
    $categories = Category::findAll();
    $locations = Location::findAll();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>

<div class="footerBackground">

<div class="container">
<div class="width-12">
    <ul class="footer">

        <div class="footerInfo">
        <div class="legalFooter">
            <h3>Legal</h3>
            <ul>Terms of use</ul>
            <ul>Privacy Policy</ul>
            <ul>EU Privacy Rights</ul>
            <ul>Cookie Policy</ul>
            <ul>Manage Privacy Preferences</ul>
        </div>

        <div class="linksFooter">
            <h3>Region</h3>
            <?php foreach ($locations as $l) { ?>
                <a href="location.php?id=<?= $l->id ?>"><?= $l->name ?></a>
            <?php } ?>
        </div>

         <div class="linksFooter">
            <h3>Categories</h3>
            <?php foreach ($categories as $c) { ?>
                <a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a>
            <?php } ?>
        </div>

        <div class="titleFooter">
            <h1>The Post</h1>
        </div>

        </div>

        
    </ul>
</div>

</div>
</div>

<script src="story_filters.js"></script>