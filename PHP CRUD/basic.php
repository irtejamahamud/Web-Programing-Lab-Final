<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="f_name">Name:</label>
    <input type="text" name="f_name" ><br><br>
   
    <label for="f_id">ID:</label>
    <input type="text" name="f_id" ><br><br>
   
    <label for="course_code">Course Code:</label>
    <input type="text" name="course_code" ><br><br>
   
    <label for="section">Section:</label>
    <input type="text" name="section" ><br><br>
   
    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['f_name'], $_POST['f_id'], $_POST['course_code'], $_POST['section'])) {
        $name = $_POST['f_name'];
        $id = $_POST['f_id'];
        $course_code = $_POST['course_code'];
        $section = $_POST['section'];

        if (empty($name) || empty($id) || empty($course_code) || empty($section)) {
            echo "Please fill in all fields";
        } else {
            echo "Name: $name<br>";
            echo "ID: $id<br>";
            echo "Course Code: $course_code<br>";
            echo "Section: $section<br>";
        }
    } else {
        echo "Please fill in all fields";
    }
}


    //Greeting();
    //Grade(3.5);
   
    function Greeting(){
        $t = date("H");
        echo "Time: $t<br>";
        if ($t < 12) {
            echo "Good Morning";
        } elseif ($t < 18) {
            echo "Good Afternoon";
        } else {
            echo "Good Evening";
        }
    }

    function Grade($g){
        switch($g){
            case 4:
                echo "You have Got A+";
                break;
            case 3.75:
                echo "You have Got A";
                break;
            case 3.5:
                echo "You have Got A-";
                break;
            case 3:
                echo "You have Got B+";
                break;
            case 2.75:
                echo "You have Got B";
                break;
            default:
                echo "Wrong Grade";
        }
    }

    function adder($a,$b){
        return $a+$b;
    }

   
// for ($i = 0; $i < 10; $i++) {
//     echo "Addition of " . $i . "+" . $i . " is: " . adder($i, $i) . "<br>";
// }

// $arr = [3, 2, 0];
// sort($arr);
// $arr1 = $arr;

// foreach ($arr1 as $value) {
//     echo $value;
// }

// $info = array("irteja"=>"16","sezan"=>"35");

// foreach($info as $x => $x_value){
//     echo "Name".$x."Id".$x_value;
// }


// echo $_SERVER['SERVER_NAME']


    ?>

   
</body>
</html>
