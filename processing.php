<?php
// Include database initialization
require('dbinit.php');

// Handle chocolate deletion if requested
if (isset($_GET['chocolate_id'])) {
    $chocolate_id = $_GET['chocolate_id'];

    // Prepare the delete query
    $delete_query = "DELETE FROM chocolates WHERE ChocolateID = ?";
    $stmt = mysqli_prepare($dbc, $delete_query);
    mysqli_stmt_bind_param($stmt, 'i', $chocolate_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: details.php"); // Redirect to details page
        exit();
    } else {
        echo "Error removing chocolate: " . mysqli_error($dbc);
    }
}

// Retrieve all chocolate data
$query = "SELECT * FROM chocolates";
$results = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="insert.php"><h1>Admin Chocolate Inventory</h1></a>
    <a href="insert.php"><button>Add New Chocolate</button></a>
</header>

<section>
    <?php
    if (mysqli_num_rows($results) > 0) {
        echo "<table>";
        echo "<thead><tr><th>Name</th><th>Description</th><th>Brand</th><th>Price</th><th>Quantity</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td>{$row['ChocolateName']}</td>";
            echo "<td>{$row['ChocolateDescription']}</td>";
            echo "<td>{$row['Brand']}</td>";
            echo "<td>{$row['Price']}</td>";
            echo "<td>{$row['QuantityAvailable']}</td>";
            echo "<td><a href='edit.php?chocolate_id={$row['ChocolateID']}'>Edit</a> | <a href='details.php?chocolate_id={$row['ChocolateID']}'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No chocolates available.</p>";
    }
    ?>
</section>

<footer>
    <p>Admin Portal - Chocolate Inventory</p>
</footer>
</body>
</html>
