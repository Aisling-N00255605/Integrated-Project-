<?php
require_once '../lib/config.php';
require_once '../lib/global.php';
require_once '../lib/session.php';


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

    $story = Story::findById($data['id']);
    if (!$story) {
        throw new Exception('article not found.');
    }

    if ($story->imageFilename) {
        $uploader = new ImageUpload();
        $uploader->deleteImage($story->imageFilename);
    }

    $story->delete();
    clearFormData();
    clearFormErrors();
    setFlashMessage('success', 'Article deleted successfully.');
    redirect('/index.php');
}

catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    if (isset($data['id']) && $data['id']) {
        redirect('/admin/view_storyadmin.php?id=' . $data['id']);
    }
    else {
        redirect('/index.php');
    }
}