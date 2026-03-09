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
    <title>Create Story</title>
</head>
<body>
    <?php require_once "./lib/navbar.php"; ?>
    <?php require_once "./lib/flash_message.php"; ?>

    <h1>Create Story</h1>

    <form action="story_store.php" method="POST">

        <div class="input">
            <label for="headline">Headline:</label>
            <div>
                <input type="text" id="headline" name="headline" value="<?= old('headline') ?>" required>
                <p class="error"><?= error('headline') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="short_headline">Short_headline:</label>
            <div>
                <input type="text" id="short_headline" name="short_headline" value="<?= old('short_headline') ?>" required>
                <p class="error"><?= error('short_headline') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="subheadline">Subheadline:</label>
            <div>
                <input type="text" id="subheadline" name="subheadline" value="<?= old('subheadline') ?>" required>
                <p class="error"><?= error('subheadline') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="author_id">Author:</label>
            <div>
                <select name="author_id" id="author_id">
                    <?php foreach ($authors  as $author) { ?>
                        <option value="<?= $author->id ?>" <?= chosen('author_id', $author->id) ? 'selected' : '' ?>><?= $author->first_name . " " . $author -> last_name ?></option>
                    <?php } ?>
                </select>
                <p class="error"><?= error('author_id') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="category_id">Category:</label>
            <div>
                <select name="category_id" id="category_id">
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= $cat->id ?>" <?= chosen('category_id', $cat->id) ? 'selected' : '' ?>><?= $cat->name ?></option>
                    <?php } ?>
                </select>
                <p class="error"><?= error('category_id') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="location_id">Location:</label>
            <div>
                <select name="location_id" id="location_id">
                    <?php foreach ($locations as $loc) { ?>
                        <option value="<?= $loc->id ?>" <?= chosen('location_id', $loc->id) ? 'selected' : '' ?>><?= $loc->name ?></option>
                    <?php } ?>
                </select>
                <p class="error"><?= error('location_id') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="article">Article:</label>
            <div>
                <textarea name="article" id="article" required><?= old('article') ?></textarea>
                <p class="error"><?= error('article') ?></p>
            </div>
        </div>

        <div class="input">
            <label for="article">Headline Image:</label>
            <input type="file" id="article" name="article" accept="image/">

        </div>

        <!-- TODO: Add fields for short_headline, subheadline, img_url, author, category, and location -->

        <button type="submit">Create Story</button>
    </form>
</body>
</html>

<?php
// TODO: Clear form data and errors from the session after displaying the form
