<?php
session_start();
include_once('connection.php');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $stmt = $mysqli->prepare("DELETE FROM student WHERE st_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<div class='success'>Deleted Successfully</div>";
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='error'>Error deleting record: " . $mysqli->error . "</div>";
    }

    $stmt->close();
}

$mysqli->close();
?>
