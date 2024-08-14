<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT student.*, classes.name as class_name FROM student LEFT JOIN classes ON student.class_id = classes.class_id WHERE student.id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>
<!--displaying all data-->
<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
</head>
<body>
    <h1><?php echo $student['name']; ?></h1>
    <p>Email: <?php echo $student['email']; ?></p>
    <p>Address: <?php echo $student['address']; ?></p>
    <p>Class: <?php echo $student['class_name']; ?></p>
    <p>Created At: <?php echo $student['created_at']; ?></p>
    <img src="uploads/<?php echo $student['image']; ?>" width="100" />
</body>
</html>
