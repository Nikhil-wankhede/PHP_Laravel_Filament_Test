<?php

// Function to handle image uploads
function uploadImage($fileInputName, $uploadDir) {
    // Check if the upload directory exists; if not, create it with appropriate permissions
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // 0755 permissions allow read and execute for everyone, write for the owner
    }

    // Check if the file input exists and if there were no upload errors
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return "No file uploaded or there was an upload error.";
    }

    // Get the uploaded file information
    $file = $_FILES[$fileInputName];
    
    // Define allowed MIME types for image uploads
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    // Get the MIME type of the uploaded file
    $fileMimeType = mime_content_type($file['tmp_name']);
    
    // Check if the uploaded file's MIME type is allowed
    if (!in_array($fileMimeType, $allowedMimeTypes)) {
        return "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
    }

    // Define the maximum file size (2MB)
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    // Check if the uploaded file exceeds the maximum file size
    if ($file['size'] > $maxFileSize) {
        return "File size exceeds the maximum limit of 2MB.";
    }

    // Get the file extension of the uploaded file
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    // Generate a unique file name to avoid overwriting existing files
    $uniqueFileName = uniqid('img_', true) . '.' . $fileExtension;

    // Create the destination path for the uploaded file
    $destination = rtrim($uploadDir, '/') . '/' . $uniqueFileName;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return "File uploaded successfully: " . htmlspecialchars($uniqueFileName);
    } else {
        return "Failed to move uploaded file.";
    }
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Call the uploadImage function and echo the result
    $result = uploadImage('image', 'uploads');
    echo $result;
}
?>