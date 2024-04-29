<?php

include 'includes/server.php';


if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($connect, $_GET['id']);


    $sql = "DELETE FROM `education` WHERE id = $id";


    $result = mysqli_query($connect, $sql);


    if ($result) {

        header("Location: education.php?msg=data_deleted");
        exit();
    } else {

        echo "Failed: " . mysqli_error($connect);
    }
} else {

    echo "No ID provided for deletion";
}
?>