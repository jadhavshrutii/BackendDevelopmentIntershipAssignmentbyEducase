<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    $image = $_FILES['image']['name'];

    //validate and upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (in_array($imageFileType, ['jpg', 'png'])) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = "INSERT INTO student (name, email, address, class_id, image) VALUES ('$name', '$email', '$address', $class_id, '$image')";
        $conn->query($sql);
        header('Location: index.php');
    } else {
        echo "Invalid image format. Only JPG and PNG are allowed.";
    }
}

$classes = $conn->query("SELECT * FROM classes");
?>
<!-- adding new student-->
<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
</head>
<body>
    <h1>Add New Student</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="address">Address:</label>
        <textarea name="address"></textarea><br>

        <label for="class_id">Class:</label>
        <select name="class_id">
            <?php while ($row = $classes->fetch_assoc()): ?>
            <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select><br>

        <label for="image">Image:</label>
        <input type="file" name="image" accept=".jpg, .png" required><br>

        <button type="submit">Add Student</button>
    </form>
</body>
</html>
