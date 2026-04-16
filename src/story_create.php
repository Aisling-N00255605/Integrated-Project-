<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

startSession();

try {
    $categories = Category::findAll();
    $authors = Author::findAll();
    $locations = Location::findAll();

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">

    <title>Create Story</title>
</head>

<!-- -------------JavaScript------------- -->
<script>
    function toggleNewField(type) {
        const select = document.getElementById(type + '_id');
        const field = document.getElementById('new_' + type + '_field');

        if (select.value === 'new') {
            field.style.display = 'block';
        } else {
            field.style.display = 'none';
        }
    }
</script>


<body>
    <?php require_once "./lib/navbar.php"; ?>
    <?php require_once "./lib/flash_message.php"; ?>

    <form action="story_store.php" method="POST" enctype="multipart/form-data">
    <!-- -------------Headline------------- -->
    <div class="container">
    <div class="width-6">
        <h1>Create Story</h1>
        <div class="input">
            <label for="headline">Headline:</label>
            <div>
                <input type="text" id="headline" name="headline" value="<?= old('headline') ?>" required>
                <p class="error"><?= error('headline') ?></p>
            </div>
        </div>

        <!-- -------------Short Headline------------- -->
        <div class="input">
            <label for="short_headline">Short_headline:</label>
            <div>
                <input type="text" id="short_headline" name="short_headline" value="<?= old('short_headline') ?>" required>
                <p class="error"><?= error('short_headline') ?></p>
            </div>
        </div>

        <!-- -------------Subheadline------------- -->
        <div class="input">
            <label for="subheadline">Subheadline:</label>
            <div>
                <input type="text" id="subheadline" name="subheadline" value="<?= old('subheadline') ?>" required>
                <p class="error"><?= error('subheadline') ?></p>
            </div>
        </div>

        <!-- -------------Author------------- -->
        <div class="input">
            <label for="author_id">Author:</label>
            <div>
                <select name="author_id" id="author_id" onchange="toggleNewField('author')">
                    <?php foreach ($authors  as $author) { ?>
                        <option value="<?= $author->id ?>" <?= chosen('author_id', $author->id) ? 'selected' : '' ?>>
                            <?= $author->first_name . " " . $author -> last_name ?></option>
                    <?php } ?>
                    <option value="new">+ Add New Author</option>
                </select>
                    <div id="new_author_field" style="display:none;">
                        <input type="text" name="new_author_name" placeholder="Enter new author name">
                    </div>
                <p class="error"><?= error('author_id') ?></p>
            </div>
        </div>

        <!-- -------------Category------------- -->
        <div class="input">
            <label for="category_id">Category:</label>
            <div>
                <select name="category_id" id="category_id" onchange="toggleNewField('category')">
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= $cat->id ?>" <?= chosen('category_id', $cat->id) ? 'selected' : '' ?>>
                            <?= $cat->name ?></option>
                    <?php } ?>
                    <option value="new">+ Add New Category</option>
                </select>
                    <div id="new_category_field" style="display:none;">
                        <input type="text" name="new_category_name" placeholder="Enter new category">
                    </div>
                <p class="error"><?= error('category_id') ?></p>
            </div>
        </div>

        <!-- -------------Location------------- -->
        <div class="input">
            <label for="location_id">Location:</label>
            <div>
                <select name="location_id" id="location_id" onchange="toggleNewField('location')">
                    <?php foreach ($locations as $loc) { ?>
                        <option value="<?= $loc->id ?>" <?= chosen('location_id', $loc->id) ? 'selected' : '' ?>>
                            <?= $loc->name ?></option>
                    <?php } ?>
                    <option value="new">+ Add New Location</option>
                </select>
                    <div id="new_location_field" style="display:none;">
                        <input type="text" name="new_location_name" placeholder="Enter new location">
                    </div>
                <p class="error"><?= error('location_id') ?></p>
            </div>
        </div>

        <!-- -------------Article------------- -->
        <div class="input">
            <label for="article">Article:</label>
            <div>
                <textarea name="article" id="article" required><?= old('article') ?></textarea>
                <p class="error"><?= error('article') ?></p>
            </div>
        </div>

        <!-- -------------Image------------- -->
        <div class="input">
            <label for="image">Headline Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <!-- -------------Button------------- -->
        <button type="submit">Create Story</button>
        </div>
        </div>
    </form>

<?php require_once "./lib/footer.php"; ?>
</body>
</html>
<?php
