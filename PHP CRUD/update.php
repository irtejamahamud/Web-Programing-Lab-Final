<?php
session_start();
include_once('connection.php');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['updateid'];

$stmt = $mysqli->prepare("SELECT st_name, st_dept FROM student WHERE st_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $st_name = $row['st_name'];
    $st_dept = $row['st_dept'];
} else {
    echo "<div class='error'>No record found!</div>";
    exit();
}

$stmt->close();

if (isset($_POST['edit'])) {
    $st_name = $_POST['st_name'];
    $st_dept = $_POST['st_dept'];

    $stmt = $mysqli->prepare("UPDATE student SET st_name = ?, st_dept = ? WHERE st_id = ?");
    $stmt->bind_param("ssi", $st_name, $st_dept, $id);

    if ($stmt->execute()) {
        echo "<div class='success'>Record updated successfully!</div>";
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='error'>Error updating record: " . $mysqli->error . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Student</h1>
        <form action="" method="post">
            <div>
                <label for="st_name">Student Name:</label>
                <input type="text" id="st_name" name="st_name" value="<?php echo htmlspecialchars($st_name); ?>" required>
            </div>
            <div>
                <label for="st_dept">Department:</label>
                <input type="text" id="st_dept" name="st_dept" value="<?php echo htmlspecialchars($st_dept); ?>" required>
            </div>
            <div>
                <input type="submit" name="edit" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
