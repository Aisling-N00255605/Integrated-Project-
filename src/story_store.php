<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

startSession();

try {
    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'headline'    => $_POST['headline'] ?? '',
        'article'     => $_POST['article'] ?? '',
        'category_id' => $_POST['category_id'] ?? '',

        'short_headline' => $_POST['short_headline'] ?? '',
        'subheadline' => $_POST['subheadline'] ?? '',
        'author_id' => $_POST['author_id'] ?? '',
        'location_id' => $_POST['location_id'] ?? '',
    ];

    $rules = [
        'headline'    => 'required|notempty|min:5|max:255',
        'article'     => 'required|notempty|min:20',
        'category_id' => 'required|integer',

        'short_headline'    => 'required|notempty|min:10|max:255',
        'subheadline'     => 'required|notempty|min:10|max:255',
        'author_id' => 'required|integer',
        'location_id'    => 'required|integer',
    ];

    $validator = new Validator($data, $rules);
    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES["image"]);

    if (!$imageFilename) {
        throw new Exception("Failed to process and save image");
    }

    $data['img_url'] = $imageFilename;

    $story = new Story($data);
    $story->save();

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Story created successfully!');
    redirect('view_story.php?id=' . $story->id);

} catch (Exception $e) {
    setFormErrors($errors);
    setFormData($data);
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    redirect('story_create.php');
}
