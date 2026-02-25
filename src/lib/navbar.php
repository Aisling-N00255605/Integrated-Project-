<?php

try {
    $categories = Category::findAll();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<div class="container">
<div class="width-12">
<ul class="navbar">
    <li><a href="index.php">Home</a></li>
    <?php foreach ($categories as $c) { ?>
        <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
    <?php } ?>
</ul>
</div>
</div>