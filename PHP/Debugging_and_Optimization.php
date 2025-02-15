<?php
// Function to establish a database connection using PDO
function getDatabaseConnection() {
    // Declare a static variable to hold the database connection
    static $db = null;

    // Check if the database connection has not been established yet
    if ($db === null) {
        // Create a new PDO instance to connect to the MySQL database
        // Replace 'localhost', 'test', 'root', and '' with your actual database host, name, username, and password
        $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        
        // Set the PDO error mode to exception to handle errors gracefully
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Return the established database connection
    return $db;
}

// Function to retrieve posts for a specific user by user ID
function getUserPosts($userId) {
    // Get the database connection
    $db = getDatabaseConnection();

    // Prepare an SQL statement to select posts for the given user ID
    $stmt = $db->prepare("SELECT id, title, content FROM posts WHERE user_id = ?");
    
    // Execute the prepared statement with the user ID as a parameter
    $stmt->execute([$userId]);
    
    // Fetch all results as an associative array and return them
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>