<?php

// Retrieve the 'id' parameter from the URL query string using the GET method
$id = $_GET['id'];

// Prepare an SQL statement to select all columns from the 'users' table where the 'id' matches the provided value
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");

// Bind the 'id' parameter to the prepared statement
// The "i" indicates that the parameter is of type integer
$stmt->bind_param("i", $id);

// Execute the prepared statement
$stmt->execute();

// Get the result set from the executed statement
$result = $stmt->get_result();

?>