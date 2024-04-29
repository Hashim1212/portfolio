<?php
include 'includes/server.php';


if(isset($_POST['message_id']) && !empty($_POST['message_id'])) {
    
    $message_id = mysqli_real_escape_string($connect, $_POST['message_id']);

    
    $query = "DELETE FROM contact_messages WHERE id = '$message_id'";

    
    if(mysqli_query($connect, $query)) {
        
        header("Location: dashboard.php?delete_success=1");
        exit();
    } else {
        
        header("Location: dashboard.php?delete_error=1");
        exit();
    }
} else {
    
    header("Location: dashboard.php");
    exit();
}
?>
