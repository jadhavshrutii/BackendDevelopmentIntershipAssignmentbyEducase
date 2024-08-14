<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

#edit student data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    $image = $_FILES['image']['name'];

    if ($image) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ['jpg', 'png'])) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            $sql = "UPDATE student SET name='$name', email='$email', address='$address', class_id=$class_id, image='$image' WHERE id=$id";
        } else {
            echo "Invalid image format. Only JPG and PNG are allowed
