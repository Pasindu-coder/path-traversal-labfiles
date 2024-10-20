<?php
// Path to the directory containing files
$baseDir = 'files/';

// Retrieve the 'file' parameter from the GET request
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Construct the file path
    $filePath = $baseDir . $file;

    // Check if the file exists and is readable
    if (file_exists($filePath) && is_readable($filePath)) {
        // Read and display the file's content
        echo '<pre>' . htmlspecialchars(file_get_contents($filePath)) . '</pre>';
    } else {
        // Check for path traversal attempt by looking for "../" or similar patterns
        if (strpos($file, '../') !== false || strpos($file, '..\\') !== false) {
            // If path traversal is detected, show the success message and flag
            $flag = "FLAG{path_traversal_successful_secret_pass_key_12345}";
            $message = "The vulnerability is exploited successfully! Flag: $flag";
            header("Location: index.html?message=" . urlencode($message));
            exit;
        } else {
            echo "File not found or cannot be read.";
        }
    }
}
?>
