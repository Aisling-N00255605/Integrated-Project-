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
        'id' => $_POST['id'] ?? null,
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

    // Find the book
    $story = Story::findById($data['id']);
    if (!$story) throw new Exception('article not found.');

    // Handle cover image
    $imageFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('image')) {
        if ($story->imageFilename) {
            $uploader->deleteImage($story->imageFilename);
        }
        $imageFilename = $uploader->process($_FILES['image']);
        if (!$imageFilename) throw new Exception('Failed to save article cover image.');
    }

    // Update book properties
    $story->headline = $data['headline'];
    $story->article = $data['article'];
    $story->category_id = $data['category_id'];
    $story->short_headline = $data['short_headline'];
    $story->subheadline = $data['subheadline'];
    $story->author_id = $data['author_id'];
    $story->location_id = $data['location_id'];
    if ($imageFilename) {
    $story->imageFilename = $imageFilename;
}

    $story->save();
    setFlashMessage('success', 'Story edited successfully!');
    redirect('view_story.php?id=' . $story->id);
    // clearFormData();
    // clearFormErrors();

    // setFlashMessage('success', 'Story edited successfully!');
    // redirect('view_story.php?id=' . $story->id);

} catch (Exception $e) {
    // Delete uploaded cover if something failed
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());
    setFormData($data);
    setFormErrors($errors);

    if (isset($data['id']) && $data['id']) {
        redirect('story_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}