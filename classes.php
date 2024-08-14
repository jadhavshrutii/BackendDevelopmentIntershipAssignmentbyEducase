<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    if ($_POST['action'] == 'add') {
        $sql = "INSERT INTO classes (name) VALUES ('$name')";
    } elseif ($_POST['action'] == 'edit') {
        $class_id = $_POST['class_id'];
        $sql = "UPDATE classes SET name='$name' WHERE class_id=$class_id";
    }
    $conn->query($sql);
    header('Location: classes.php');
}

if (isset($_GET['delete'])) {
    $class_id = $_GET['delete'];
    $sql = "DELETE FROM classes WHERE class_id=$class_id";
    $conn->query($sql);
    header('Location: classes.php');
}

$classes = $conn->query("SELECT * FROM classes");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
</head>
<body>
    <h1>Manage Classes</h1>
    <form action="" method="post">
        <label for="name">Class Name:</label>
        <input type="text" name="name" required><br>
        <button type="submit" name="action" value="add">Add Class</button>
    </form>

    <h2>All Classes</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $classes->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                    <button type="submit" name="action" value="edit">Edit</button>
                </form>
                <a href="classes.php?delete=<?php echo $row['class_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
