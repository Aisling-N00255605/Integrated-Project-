<?php

try {
    $categories = Category::findAll();
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
        <input type="text" placeholder="Search..">
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