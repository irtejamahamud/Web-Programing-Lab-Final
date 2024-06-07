<?php
session_start();
include_once('connection.php');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['st_name']) && !empty($_POST['st_dept']) && !empty($_FILES['image']['name'])) {
        $name = $mysqli->real_escape_string($_POST['st_name']);
        $dept = $mysqli->real_escape_string($_POST['st_dept']);
        $fileName = basename($_FILES['image']['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            $stmt = $mysqli->prepare("INSERT INTO student (st_name, st_dept, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $dept, $imgContent);

            if ($stmt->execute()) {
                echo "<div class='success'>Submitted Successfully</div>";
            } else {
                echo "<div class='error'>Not Submitted!</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='error'>Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.</div>";
        }
    } else {
        echo "<div class='error'>Please fill all fields and select an image to upload.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Student</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="st_name">Student Name:</label>
                <input type="text" id="st_name" name="st_name" required>
            </div>
            <div>
                <label for="st_dept">Department:</label>
                <select id="st_dept" name="st_dept" required>
                    <option value="CSE">CSE</option>
                    <option value="EEE">EEE</option>
                    <option value="BBB">BBB</option>
                    <option value="LAW">LAW</option>
                    <option value="ENG">ENG</option>
                    <option value="TEX">TEX</option>
                </select>
            </div>
            <div>
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Insert">
            </div>
        </form>
    </div>

    <?php
    $sql = "SELECT st_id, st_name, st_dept, image FROM student";
    echo '<table>
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Student Dept</th>
        <th>Image</th>
        <th><font color="green">Edit</font></th>
        <th><font color="red">Delete</font></th>
    </tr>';

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $ID = htmlspecialchars($row["st_id"]);
            $Name = htmlspecialchars($row["st_name"]);
            $Dept = htmlspecialchars($row["st_dept"]);
            $Image = base64_encode($row["image"]);

            echo '<tr>
            <td>' . $ID . '</td>
            <td>' . $Name . '</td>
            <td>' . $Dept . '</td>
            <td><img src="data:image/jpeg;base64,' . $Image . '" alt="Image" width="50" height="60"></td>
            <td><a class="update" href="update.php?updateid=' . $ID . '">Update</a></td>
            <td><a class="delete" href="datadelete.php?deleteid=' . $ID . '">Delete</a></td>
            </tr>';
        }
        $result->free();
    }
    $mysqli->close();
    echo '</table>';
    ?>
</body>
</html>
