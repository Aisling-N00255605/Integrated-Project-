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

<div class="navBarBackground">

<div class="container">
<div class="width-12">
    <ul class="navbar">
        <!-- <input type="text" placeholder="Search.."> -->
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Filters</button>
                <div id="myDropdown" class="dropdown-content">
                    <?php foreach ($categories as $c) { ?>
                        <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
                    <?php } ?>

                    <?php foreach ($locations as $l) { ?>
                        <li><a href="filterPage.php?id=<?= $l->id ?>"><?= $l->name ?></a></li>
                    <?php } ?>
                </div>
        </div>

        <div class="pageLinks">
                <li><a href="index.php">Home</a></li>
            <?php foreach ($categories as $c) { ?>
                <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
            <?php } ?>
                <li><a href="story_admin.php">Admin</a></li>
        </div>
    </ul>
</div>
<h1 class ="title">Name</h1>
</div>
</div>

<script src="story_filters.js"></script>