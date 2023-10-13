<?php
include 'connect.php'; // Include your database connection file
$conn = mysqli_connect('localhost','root','','sweetie') or die('connection failed');
if (isset($_GET['username'])) {
    $username = mysqli_real_escape_string($conn, $_GET['username']);
    
    // Query the database to get the list of usernames
    $query = "SELECT username FROM members";
    $result = mysqli_query($conn, $query);

    sleep(1); // Simulate a delay for demonstration purposes

    $existingUsernames = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $existingUsernames[] = $row['username'];
    }

    if (!in_array($username, $existingUsernames)) {
        // Username is not in the database
        echo "okay";
    } else {
        // Username is already in the database
        echo "denied";
    }
}
?>