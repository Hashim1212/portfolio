<?php
include 'includes/server.php';

$id = $_GET['id'];
$sql = "DELETE FROM `skills` WHERE id = $id";

$result = mysqli_query($connect, $sql);
if ($result) {
    header("Location: skills.php?msg=data deleted");
} else {
    echo "Failed: " . mysqli_error($connect);
}
