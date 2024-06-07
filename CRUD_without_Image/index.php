<?php
session_start();
include_once('connection.php');
?>
<form action="" method="post">
    <div>
        Student Name: <input type="text" name="st_name" value="" /><br><br>
        Department Name: <input type="text" name="st_dept" value="" /><br><br>
        <input type="submit" name="submit" value="Insert" /><br><br>
    </div>
</form>

<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['st_name']) && !empty($_POST['st_dept'])) {
        $name = $_POST['st_name'];
        $dept = $_POST['st_dept'];
        $sql = "INSERT INTO student (st_name, st_dept) VALUES('$name','$dept')";

        if ($mysqli->query($sql)) {
            echo "Submitted Successfully";
        } else {
            echo "Not Submitted! Error: " . $mysqli->error;
        }
    }
}

$sql = "SELECT st_id, st_name, st_dept FROM student";
echo '<table style="width:60%" border="2">
<tr>
<th>ID</th>
<th>Student Name</th>
<th>Student Dept</th>
<th><font color="green">Edit</font></th>
<th><font color="red">Delete</font></th>
</tr>';

if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $ID = $row["st_id"];
        $Name = $row["st_name"];
        $Dept = $row["st_dept"];

        echo '<tr>
        <td>' . $ID . '</td>
        <td>' . $Name . '</td>
        <td>' . $Dept . '</td>
        <td><button class="button-primary"><a href="update.php?updateid=' . $ID . '">Update</a></button></td>
        <td><button class="button-primary"><a href="datadelete.php?deleteid=' . $ID . '">Delete</a></button></td>
        </tr>';
    }
    $result->free();
}
$mysqli->close();
?>
