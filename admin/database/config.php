<?php
// Determine if the environment is local or production
$isLocal = ($_SERVER['SERVER_NAME'] === 'localhost');

// Set database credentials based on environment
$dbConfig = $isLocal ? [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'irn_cafe',
    'port' => 3306,
] : [
    'host' => 'production_db_host',
    'user' => 'production_user',
    'password' => 'production_password',
    'database' => 'production_db',
    'port' => 3306,
];

// Create connection
$conn = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database'], $dbConfig['port']);

// Check connection
if ($conn->connect_error) {
    // Log the detailed error for debugging
    error_log("Database Connection Failed: " . $conn->connect_error, 3, __DIR__ . '/logs/db_errors.log');
    
    // Display a generic error message to the user
    die("Oops! Something went wrong while connecting to the database.");
}

// Optional: Set character set to UTF-8 for compatibility
if (!$conn->set_charset("utf8mb4")) {
    error_log("Error loading character set utf8mb4: " . $conn->error, 3, __DIR__ . '/logs/db_errors.log');
    die("Oops! Something went wrong while setting up the database.");
}

// Connection successful
?>
