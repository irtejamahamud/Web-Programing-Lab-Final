<?php
session_start();
include_once('connection.php');
?>

<?php
if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM student WHERE st_id=$id";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    $st_name = $row['st_name'];
    $st_dept = $row['st_dept'];
}

if (isset($_POST['edit'])) {
    $st_name = $_POST['st_name'];
    $st_dept = $_POST['st_dept'];

    $sql = "UPDATE student SET st_name='$st_name', st_dept='$st_dept' WHERE st_id=$id";
    $run = mysqli_query($mysqli, $sql);

    if ($run) {
        header("Location: index.php"); // Redirect to index.php after successful update
        exit();
    } else {
        echo "Update Failed! Error: " . mysqli_error($mysqli);
    }
}
?>

<form action="" method="post">
    <div>
        Student Name: <input type="text" name="st_name" value="<?php echo htmlspecialchars($st_name); ?>" /><br><br>
        Department Name: <input type="text" name="st_dept" value="<?php echo htmlspecialchars($st_dept); ?>" /><br><br>
        <input type="submit" name="edit" value="Update" /><br><br>
    </div>
</form>
