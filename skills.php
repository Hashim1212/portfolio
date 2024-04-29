<?php
session_start();
include 'includes/server.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $perc = $_POST['perc'];


  $sql = "INSERT INTO `skills`(skillName,lvl) VALUES ( '$title','$perc')";

  $result = mysqli_query($connect, $sql);
  if ($result) {
      header("Location: skills.php?msg=New data created");
  } else {
      echo "Failed: " . mysqli_error($connect);
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
<div class="container">
    <body class="edtpage">
        <div class="card2">
<section class="is-title-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <ul>
      <li>Admin</li>
      <li>Skills</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Skills
    </h1>
  </div>
</section>


            <div>
                <div>
                    <h3 class="edtitle">Professional Skills</h3>
                    <form action="" method="post">
                        <table style="margin-left: 20px;">
                            <tr>
                                <td><label for="">Skill Name:</label></td>
                                <td><input class="form" type="text" name="title"></td>
                            </tr>
                            <tr>
                                <td><label for="">Percent:</label></td>
                                <td><input class="form" type="text" name="perc" placeholder="1 - 100"></td>
                            </tr>
                        </table>
                        <br>
                        <div style="padding-left: 30px; margin-bottom: 20px;">
                            <button class="green-btn" type="submit" name="submit">Add</button>
                        </div>

                </div>
                </form>
            </div>
            <div>
            <div>
        <table>
            <tr>
                <?php
                $sql = "SELECT * FROM `skills`";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo '<td>No Data Yet</td>';
                } else {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($count % 3 == 0 && $count > 0) {
                            echo "</tr><tr>";
                        }
                ?>
                        <td>
                            <div class="incontent">
                                <div style="margin-left: 20px;">
                                    <span style="font-weight: bolder;"><?php echo $row['skillName'] ?></span> |
                                    <?php echo $row['lvl'] ?>%
                                    <br>
                                    <a href="del.php?id=<?php echo $row['id'] ?>"><button class="red-btn">Delete</button></a>
                                </div>
                            </div>
                        </td>
                <?php
                        $count++;
                    }
                }
                ?>
            </tr>
        </table>
            </div>
    </div>

            <br>
            <br>
        </div>


    </body>
    </div>


<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>