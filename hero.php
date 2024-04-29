<?php
session_start();
include 'includes/server.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Admin One Tailwind CSS Admin Dashboard</title>

  <link rel="stylesheet" href="assets/css/main2.css?v=1628755089081">
  <link rel="stylesheet" href="assets/css/style.css">
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
      <li>Hero</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Hero
    </h1>
  </div>
</section>


<div class="container">
<?php
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    if(isset($_FILES['img1']) && $_FILES['img1']['error'] === UPLOAD_ERR_OK) {
        $img1Name = $_FILES['img1']['name'];
        $img1Temp = $_FILES['img1']['tmp_name'];
        move_uploaded_file($img1Temp, "assets/uploads/" . $img1Name);
        $connect->query("UPDATE img SET `img-1` = 'assets/uploads/$img1Name' WHERE id = $id");
    }
    if(isset($_FILES['img2']) && $_FILES['img2']['error'] === UPLOAD_ERR_OK) {
        $img2Name = $_FILES['img2']['name'];
        $img2Temp = $_FILES['img2']['tmp_name'];
        move_uploaded_file($img2Temp, "assets/uploads/" . $img2Name);
        $connect->query("UPDATE img SET `img-2` = 'assets/uploads/$img2Name' WHERE id = $id");
    }
}

$result = $connect->query("SELECT * FROM img");

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Image 1</th><th>Image 2</th><th>Upload New Images</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td><img src='{$row["img-1"]}' width='100'></td>";
        echo "<td><img src='{$row["img-2"]}' width='100'></td>";
        echo "<td><form method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='id' value='{$row['id']}'>";
        echo "<input type='file' id='img1' name='img1' accept='image/*'><br><br>";
        echo "<input type='file' id='img2' name='img2' accept='image/*'><br><br>";
        echo "<button type='submit' name='submit' class='green-btn'>Upload</button>";
        echo "</form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No images found.";
}
?>


</div>

<script>
    document.getElementById('img1').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            this.setAttribute('placeholder', file.name);
        } else {
            this.setAttribute('placeholder', 'No file chosen for image 1');
        }
    });

    document.getElementById('img2').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            this.setAttribute('placeholder', file.name);
        } else {
            this.setAttribute('placeholder', 'No file chosen for image 2');
        }
    });
</script>
  </div>
  </div>
  </div>
  </body>


<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
<script type="text/javascript" src="assets/js/chart.sample.min.js"></script>
  <script type="text/javascript" src="assets/js/main2.min.js?v=1628755089081"></script>
</body>
</html>