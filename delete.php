<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Fetching student image to delete
    $sql = "SELECT image FROM student WHERE id=$id";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
    $image = $student['image'];

    //Deleting student record
    $sql = "DELETE FROM student WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Delete image file
        if ($image && file_exists("uploads/$image")) {
            unlink("uploads/$image");
        }
        header('Location: index.php');
    }
}
