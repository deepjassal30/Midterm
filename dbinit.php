<?php
// Database connection settings
$host = 'localhost';  // Change this if you're using a different host
$db = 'chocolate_shop';  // Change this to the name of your database
$user = 'root';  // Change this to your database username
$password = '';  // Change this to your database password

// Establish the database connection
$dbc = mysqli_connect($host, $user, $password, $db);

// Check if the connection was successful
if (!$dbc) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Optional: You can create a database and a table if they don't already exist
$create_table_query = "CREATE TABLE IF NOT EXISTS chocolates (
    ChocolateID INT AUTO_INCREMENT PRIMARY KEY,
    ChocolateName VARCHAR(255) NOT NULL,
    ChocolateDescription TEXT NOT NULL,
    Brand VARCHAR(100) NOT NULL,
    QuantityAvailable INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL
)";

if (!mysqli_query($dbc, $create_table_query)) {
    die("Error creating table: " . mysqli_error($dbc));
}
?>
