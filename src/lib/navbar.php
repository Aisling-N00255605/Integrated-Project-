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

                    <button class="subDropBtn"> Categories </button>
                        <div class="subDropdown">
                            <?php foreach ($categories as $c) { ?>
                                <a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a>
                            <?php } ?>
                        </div>

                    <button class="subDropBtn">Locations</button>
                        <div class="subDropdown">
                            <?php foreach ($locations as $l) { ?>
                                <a href="location.php?id=<?= $l->id ?>"><?= $l->name ?></a>
                            <?php } ?>
                        </div>
                </div>
        </div>

        <div class="width-12 titleOfPage">
            <h1>The Post</h1>
        </div>

        <div class="pageLinks">
                <li><a href="index.php">Home</a></li>
            <!-- <?php foreach ($categories as $c) { ?>
                <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
            <?php } ?> -->
                <li><a href="admin/story_admin.php">Admin</a></li>
        </div>
    </ul>
</div>

</div>
</div>

<script src="story_filters.js"></script>