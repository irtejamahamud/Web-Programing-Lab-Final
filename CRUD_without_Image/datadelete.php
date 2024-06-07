<?php
session_start();
include_once('connection.php');

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']); // Sanitize the input to ensure it's an integer
    $sql = "DELETE FROM student WHERE st_id='$id'";

    if (mysqli_query($mysqli, $sql)) {
        echo "<h1>Deleted Successfully</h1>";
        header("Location: index.php");
        exit(); // Ensure no further code is executed after the header redirection
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
}
$mysqli->close();
?>
