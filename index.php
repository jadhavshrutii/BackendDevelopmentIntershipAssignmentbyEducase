<?php
include 'db.php';

$sql = "SELECT student.id, student.name, student.email, student.created_at, student.image, classes.name as class_name
        FROM student
        LEFT JOIN classes ON student.class_id = classes.class_id";
$result = $conn->query($sql);
?>
<!--fetching and displaying all students-->
<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Students List</h1>
    <a href="create.php">Add New Student</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['class_name']; ?></td>
            <td><img src="uploads/<?php echo $row['image']; ?>" width="50" /></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="view.php?id=<?php echo $row['id']; ?>">View</a>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
