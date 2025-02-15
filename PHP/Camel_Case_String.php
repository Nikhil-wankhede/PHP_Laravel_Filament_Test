<?php
// Function to convert a camelCase string to a space-separated string
function camelCaseToSpaces($input) {
    
    // Use a regular expression to find positions in the string where a lowercase letter is followed by an uppercase letter
    // The pattern '/([a-z])([A-Z])/' captures these two groups
    // The replacement '$1 $2' inserts a space between the two captured groups
    $output = preg_replace('/([a-z])([A-Z])/', '$1 $2', $input);
    
    // Convert the entire output string to lowercase
    $output = strtolower($output);
    
    // Return the modified string
    return $output;
}

// Example camelCase string to be converted
$camelCaseString = "camelCaseString";

// Call the function to convert the camelCase string to a space-separated string
$convertedString = camelCaseToSpaces($camelCaseString);

// Output the converted string
echo $convertedString;
?>