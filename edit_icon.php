<?php
session_start();
include 'includes/server.php';


if(isset($_GET['id'])) {
    
    $id = $_GET['id'];

    
    $query = "SELECT * FROM icons WHERE id = $id";
    $result = mysqli_query($connect, $query);

    
    if ($result && mysqli_num_rows($result) > 0) {
        
        $icon = mysqli_fetch_assoc($result);

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $icon_name = $_POST['icon_name'];
            $icon_desc = $_POST['icon_desc'];
            $count = $_POST['count'];

            
            $update_query = "UPDATE icons SET icon_name = '$icon_name', icon_desc = '$icon_desc', count = '$count' WHERE id = $id";
            $update_result = mysqli_query($connect, $update_query);

            
            if ($update_result) {
                
                header("Location: about.php");
                exit();
            } else {
                
                echo "Error updating icon information.";
            }
        }
    } else {
        
        echo "Icon not found.";
    }
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Edit Icon</title>
</head>
<body class="edtpage">
    <div class="container">
        <div>
            <div class="card1">
                <h2>Edit Icon</h2>
                <form method="post">
                    <label for="icon_name">Icon Name:</label><br>
                    <input type="text" id="icon_name" name="icon_name" value="<?php echo $icon['icon_name']; ?>"><br>
                    <label for="icon_desc">Icon Description:</label><br>
                    <input type="text" id="icon_desc" name="icon_desc" value="<?php echo $icon['icon_desc']; ?>"><br>
                    <label for="count">Count:</label><br>
                    <input type="text" id="count" name="count" value="<?php echo $icon['count']; ?>"><br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
