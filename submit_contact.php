<?php
include 'includes/server.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $subject = mysqli_real_escape_string($connect, $_POST['subject']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "error"; 
    } else {
        
        $insertQuery = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);

        
        if (mysqli_stmt_execute($stmt)) {
            echo "success"; 
        } else {
            echo "error"; 
        }

        
        mysqli_stmt_close($stmt);
    }
}
?>
