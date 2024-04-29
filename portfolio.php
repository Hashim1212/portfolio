<?php
session_start();
include 'includes/server.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

$sql = "SELECT * FROM portfolio";
$result = $connect->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = mysqli_real_escape_string($connect, $_POST['id']);

  if(isset($_POST['update'])) {
      $title = isset($_POST['title']) ? mysqli_real_escape_string($connect, $_POST['title']) : '';
      $description = isset($_POST['description']) ? mysqli_real_escape_string($connect, $_POST['description']) : '';

      if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          $imgName = $_FILES['image']['name'];
          $imgTemp = $_FILES['image']['tmp_name'];
          $uploadDir = "assets/uploads/";
          $uploadedFile = $uploadDir . $imgName;
          if(move_uploaded_file($imgTemp, $uploadedFile)) {
              $updateQuery = "UPDATE portfolio SET";
              if (!empty($title)) {
                  $updateQuery .= " title = '$title',";
              }
              if (!empty($description)) {
                  $updateQuery .= " description = '$description',";
              }
              $updateQuery .= " image_src = '$uploadedFile' WHERE id = '$id'";
              
              $updateQuery = rtrim($updateQuery, ',');
              
              if($connect->query($updateQuery) === TRUE) {
                  echo "success";
              } else {
                  echo "Error: " . $updateQuery . "<br>" . $connect->error;
              }
          } else {
              echo "Error uploading file";
          }
      } else {
          $updateQuery = "UPDATE portfolio SET";
          if (!empty($title)) {
              $updateQuery .= " title = '$title',";
          }
          if (!empty($description)) {
              $updateQuery .= " description = '$description',";
          }
          $updateQuery = rtrim($updateQuery, ',');
          $updateQuery .= " WHERE id = '$id'";
          
          if($connect->query($updateQuery) === TRUE) {
              echo "success";
          } else {
              echo "Error: " . $updateQuery . "<br>" . $connect->error;
          }
      }
  }
}


?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HASHIM MAHDI ANGSA</title>

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/main2.css?v=1628755089081">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="Admin One - free Tailwind dashboard">

  <meta property="og:url" content="https://justboil.github.io/admin-one-tailwind/">
  <meta property="og:site_name" content="JustBoil.me">
  <meta property="og:title" content="Admin One HTML">
  <meta property="og:description" content="Admin One - free Tailwind dashboard">
  <meta property="og:image" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="960">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Admin One HTML">
  <meta property="twitter:description" content="Admin One - free Tailwind dashboard">
  <meta property="twitter:image:src" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="twitter:image:width" content="1920">
  <meta property="twitter:image:height" content="960">

</head>
<body>

<div id="app">

<?php include 'nav.php'; ?>
<body class="edtpage">
    <div class="container">
        <div>
            <div class="card1">

<section class="is-title-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <ul>
      <li>Admin</li>
      <li>Projects</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Projects
    </h1>
  </div>
</section>
<?php
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if(isset($_POST['submit'])) {
    if(isset($_POST['title']) && isset($_POST['description'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgName = $_FILES['image']['name'];
            $imgTemp = $_FILES['image']['tmp_name'];
            $uploadDir = "assets/uploads/";
            $uploadedFile = $uploadDir . $imgName;
            if(move_uploaded_file($imgTemp, $uploadedFile)) {
                $insertQuery = "INSERT INTO portfolio (title, description, image_src) VALUES ('$title', '$description', '$uploadedFile')";
                if($connect->query($insertQuery) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $insertQuery . "<br>" . $connect->error;
                }
            } else {
                echo "Error uploading file";
            }
        }
    } else {
        echo "Title and description are required";
    }
}

if(isset($_POST['delete'])) {
  $deleteId = $_POST['id'];
  $deleteQuery = "DELETE FROM portfolio WHERE id = '$deleteId'";
  if($connect->query($deleteQuery) === TRUE) {
      echo "<script>
              Swal.fire(
                  'Deleted!',
                  'Record has been deleted successfully.',
                  'success'
              );
           </script>";
  } else {
      echo "<script>
              Swal.fire(
                  'Error!',
                  'Error deleting record: {$connect->error}',
                  'error'
              );
           </script>";
  }
}

$result = $connect->query("SELECT * FROM portfolio");
if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th>#</th><th>Image</th><th>Title</th><th>Description</th><th>Action</th><th><th></th></tr></thead>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td><img src='{$row["image_src"]}' width='100'></td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['description']}</td>";
        echo "<td>";
        echo "<form method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='id' value='{$row['id']}'>";
        echo "<input type='file' name='image' accept='image/*'><br><br>";
        echo "<input type='text' name='title' placeholder='Title'><br><br>";
        echo "<textarea name='description' placeholder='Description'></textarea><br><br>";
        echo "<th><button type='submit' name='update' class='green-btn'>Update</button><th>";
        echo "<button type='submit' name='delete' class='red-btn'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No portfolio items found.";
}
?>

</div>

<div class="container">
<?php
    if(isset($_POST['add'])) {
        $title = mysqli_real_escape_string($connect, $_POST['title']);
        $description = mysqli_real_escape_string($connect, $_POST['description']);
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgName = $_FILES['image']['name'];
            $imgTemp = $_FILES['image']['tmp_name'];
            $uploadDir = "assets/uploads/";
            $uploadedFile = $uploadDir . $imgName;
            if(move_uploaded_file($imgTemp, $uploadedFile)) {
                $insertQuery = "INSERT INTO portfolio (title, description, image_src) VALUES ('$title', '$description', '$uploadedFile')";
                if($connect->query($insertQuery) === TRUE) {
                    echo "<script>
                            alert('New portfolio item added successfully');
                            window.location.href = 'portfolio.php'; // Redirect to the page after adding
                          </script>";
                } else {
                    echo "Error: " . $insertQuery . "<br>" . $connect->error;
                }
            } else {
                echo "Error uploading file";
            }
        }
    }
?>

<div class="container">
  <div class="card">
    <div class="card-content" style="padding: 20px;"> 
      <form method="post" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea name="description" id="description" style="width: 100%;" required></textarea><br><br>
        
        <label for="image">Image:</label><br>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>
        
        <button type="submit" name="add" class="green-btn">Add</button>
      </form>
    </div>
  </div>
</div>



  </div>
</div></div></div></body>

<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
<script type="text/javascript" src="assets/js/chart.sample.min.js"></script>
<script type="text/javascript" src="assets/js/main2.min.js?v=1628755089081"></script>
</body>
</html>
