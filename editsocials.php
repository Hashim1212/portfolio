<?php

session_start();

include 'includes/server.php';





if(isset($_GET['id'])) {

    

    $id = $_GET['id'];



    

    $query = "SELECT * FROM socials WHERE id = $id";

    $result = mysqli_query($connect, $query);



    

    if ($result && mysqli_num_rows($result) > 0) {

        

        $social = mysqli_fetch_assoc($result);

    } else {

        

        echo "Social not found.";

        exit();

    }

} else {

    

    echo "ID parameter is missing.";

    exit();

}





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

    $s_icons = $_POST['s_icons'];

    $s_link = $_POST['s_link'];



    

    $update_query = "UPDATE socials SET s_icons = '$s_icons', s_link = '$s_link' WHERE id = $id";

    $update_result = mysqli_query($connect, $update_query);



    

    if ($update_result) {

        

        header("Location: about.php");

        exit();

    } else {

        

        echo "Error updating social information.";

    }

}

?>



<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="assets/css/style.css">

  <title>Edit Social Link</title>

</head>

<body class="edtpage">

    <div class="container">

        <div>

            <div class="card1">

                <h2>Edit Social Link</h2>

                <form method="post">

                    <label for="s_icons">Social Icon:</label><br>

                    <input type="text" id="s_icons" name="s_icons" value="<?php echo $social['s_icons']; ?>"><br>

                    <label for="s_link">Social Link:</label><br>

                    <input type="text" id="s_link" name="s_link" value="<?php echo $social['s_link']; ?>"><br><br>

                    <input type="submit" value="Submit">

                </form>

            </div>

        </div>

    </div>

</body>

</html>

