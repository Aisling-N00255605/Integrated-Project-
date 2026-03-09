<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];

    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Extract form data into an array
    $data = [
        'headline'    => $_POST['headline'] ?? '',
        'article'     => $_POST['article'] ?? '',
        'category_id' => $_POST['category_id'] ?? '',

        'short_headline' => $_POST['short_headline'] ?? '',
        'subheadline' => $_POST['subheadline'] ?? '',
        'author_id' => $_POST['author_id'] ?? '',
        'location_id' => $_POST['location_id'] ?? '',
        'img_url' => $_POST['img_url'] ?? '',
        // TODO: Add the rest of your form fields here
    ];

    // Validate the data
    $rules = [
        'headline'    => 'required|notempty|min:5|max:255',
        'article'     => 'required|notempty|min:20',
        'category_id' => 'required|integer',

        'short_headline'    => 'required|notempty|min:10|max:255',
        'subheadline'     => 'required|notempty|min:10|max:255',
        'author_id' => 'required|integer',
        'location_id'    => 'required|integer',
        'img_url'     => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880',
        // TODO: Add validation rules for the rest of your fields
    ];

    $validator = new Validator($data, $rules);
    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

      $uploader = new ImageUpload();
    $imageFilename = $uploader -> process($_FILES["image"]);

    if (!$imageFilename){
        throw new Exception("Failed to process and save image");
}

    // Save the story
    $story = new Story($data);
    // $story->headline = $data['headline'];
    // $story->category_id = $data['category_id'];
    // $story->article = $data['article'];

    // $story->short_headline = $data['short_headline'];
    // $story->subheadline = $data['subheadline'];
    // $story->author_id = 1;
    // $story->location_id = 1;
    // $story->img_url = 'images/placeholder.jpg';
    
    $story->save();

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Story created successfully!');
    
    // Redirect to the view page for the newly created story
    redirect('view_story.php?id=' . $story->id);

} catch (Exception $e) {
    // Store errors and form data in the session so the form can display them
    setFormErrors($errors);
    setFormData($data);
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Redirect back to the form page
    redirect('story_create.php');
    // print_r($errors);
}
