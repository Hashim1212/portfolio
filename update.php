<?php
include 'includes/server.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = isset($_POST['id']) ? mysqli_real_escape_string($connect, $_POST['id']) : '';
    $field = isset($_POST['field']) ? mysqli_real_escape_string($connect, $_POST['field']) : '';
    $newValue = isset($_POST['newValue']) ? mysqli_real_escape_string($connect, $_POST['newValue']) : '';

    
    $query = "UPDATE admin_info SET `$field` = '$newValue' WHERE id = '$id'";

    
    $result = mysqli_query($connect, $query);

    if ($result) {
        
        echo "success";
    } else {
        
        echo "Error updating record: " . mysqli_error($connect);
    }
} else {
    
    echo "Invalid request method.";
}




if(isset($_POST['id']) && isset($_POST['content'])) {
    
    $id = $_POST['id'];
    $content = $_POST['content'];

    
    $query = "UPDATE `content-section` SET content='$content' WHERE id='$id'";
    $result = mysqli_query($connect, $query);

    
    if ($result) {
        
        echo "Success";
    } else {
        
        echo "Error updating content.";
    }
} else {
    
    echo "Missing parameters.";
}

if(isset($_POST['id'])) {
    
    $id = $_POST['id'];

    
    $icon_name = $_POST['icon_name'];
    $icon_desc = $_POST['icon_desc'];
    $count = $_POST['count'];

    
    $update_query = "UPDATE icons SET icon_name = '$icon_name', icon_desc = '$icon_desc', count = '$count' WHERE id = $id";
    $update_result = mysqli_query($connect, $update_query);

    
    if ($update_result) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
