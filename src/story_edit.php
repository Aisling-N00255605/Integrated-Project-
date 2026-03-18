<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

startSession();

try {
    $data = [];
    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id' => $_GET['id'] ?? null
    ];

    $rules = [
        'id' => 'required|integer'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }
    

    $story = Story::findById($_GET["id"]);
    $categories = Category::findAll();
    $locations = Location::findAll();
    $authors = Author::findAll();

if (!$story) {
        throw new Exception('article not found.');
    }


// catch (Exception $e) {
//     echo $e->getMessage();
//     exit();
// }

    
}catch (PDOException $e) {
        setFlashMessage('error', 'Error: ' . $e->getMessage());
        redirect('index.php');
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

    <title>Edit Story</title>
</head>
<body>
    <?php require_once "./lib/navbar.php"; ?>
    <?php require_once "./lib/flash_message.php"; ?>

    <form action="story_update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $story->id ?>">
    
<div class="container">
<div class="width-6">
        <h1>Edit Story</h1>

      <!-- -------------Headline------------- -->  
        <div class="input">
            <label for="headline">Headline:</label>
            <div>
                <input type="text" id="headline" name="headline" 
                    value="<?= old('headline', $story->headline) ?>">
                    <p> <?= error('headline') ?></p>
            </div>
        </div>

        <!-- -------------Short Headline------------- -->
        <div class="input">
            <label for="short_headline">Short_headline:</label>
            <div>
                <input type="text" id="short_headline" name="short_headline" 
                    value="<?= old('short_headline',$story->short_headline) ?>" required>
                    <p class="error"><?= error('short_headline') ?></p>
            </div>
        </div>

        <!-- -------------Subheadline------------- -->
        <div class="input">
            <label for="subheadline">Subheadline:</label>
            <div>
                <input type="text" id="subheadline" name="subheadline" 
                    value="<?= old('subheadline', $story->subheadline) ?>" required>
                    <p class="error"><?= error('subheadline') ?></p>
            </div>
        </div>

        <!-- -------------Author------------- -->
        <div class="input">
            <label for="author_id">Author:</label>
            <div>
                <select name="author_id" id="author_id">
                    <?php foreach ($authors  as $author) { ?>
                        <option value="<?= h($author->id) ?>" 
                            <?= chosen('author_id', $author->id, $story->author_id) ? 'selected' : '' ?>>
                            <?= h($author->first_name . " " . $author->last_name) ?> 
                        </option>
                    <?php } ?>
                </select>
                <p class="error"><?= error('author_id') ?></p>
            </div>
        </div>

        <!-- -------------Category------------- -->
        <div class="input">
            <label for="category_id">Category:</label>
            <div>
                <select name="category_id" id="category_id">
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= h($cat->id) ?>" 
                            <?= chosen('category_id', $cat->id, $story->category_id) ? 'selected' : '' ?>>
                            <?= h($cat->name) ?> 
                        </option>
                    <?php } ?>
                </select>
                <p class="error"><?= error('category_id') ?></p>
            </div>
        </div>

        <!-- -------------Location------------- -->
        <div class="input">
            <label for="location_id">Location:</label>
            <div>

                <select name="location_id" id="location_id">
                    <?php foreach ($locations as $loc) { ?>
                        <option value="<?= h($loc->id) ?>" 
                            <?= chosen('location_id', $loc->id, $story->location_id) ? 'selected' : '' ?>>
                            <?= h($loc->name) ?> 
                        </option>
                    <?php } ?>
                </select>
                <p class="error"><?= error('location_id') ?></p>
            </div>
        </div>

        <!-- -------------Article------------- -->
        <div class="input">
            <label for="article">Article:</label>
            <div>
                <textarea name="article" id="article">
                <?= old('article',$story->article) ?></textarea>
                <p class="error"><?= error('article') ?></p>
            </div>
        </div>

        <!-- -------------Image------------- -->
        <div class="input">
            <label for="image">Headline Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <!-- -------------Button------------- -->
         <div class="input">
         <button class="button" type="submit">Update Story</button>
        <div class="button"><a href="index.php">Cancel</a></div>
        </div>
</div>
</div>
    </form>
</body>
</html>
<?php
