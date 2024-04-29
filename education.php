<?php
session_start();
include 'includes/server.php';

// Check if the username session variable is set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if (isset($_POST['submit'])) {
    $school = mysqli_real_escape_string($connect, $_POST['school']);
    $start = mysqli_real_escape_string($connect, $_POST['start']);
    $end = mysqli_real_escape_string($connect, $_POST['end']);
    $course = mysqli_real_escape_string($connect, $_POST['course']);
    $lvl = mysqli_real_escape_string($connect, $_POST['lvl']);
    $loc = mysqli_real_escape_string($connect, $_POST['loc']);

    $sql = "INSERT INTO `education` (schoolName, yearStart, yearEnd, level, course, location) VALUES ('$school','$start','$end','$course','$lvl','$loc')";

    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("Location: education.php?msg=New data created");
        exit(); // Add this to prevent further execution of the script
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

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="assets/css/main2.css?v=1628755089081">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
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
            <div class="card2">
<section class="is-title-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <ul>
      <li>Admin</li>
      <li>Education</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Education
    </h1>
  </div>
</section>


                <h3 class="edtitle"></h3>
                <form action="" method="post">
                    <table style="margin-left: 20px;">
                        <tr>
                            <td><label for="">School:</label></td>
                            <td><input class="form" type="text" name="school" placeholder="School Name"></td>
                        </tr>
                        <tr>
                            <td><label for="">Start Year:</label></td>
                            <td><input class="form" type="text" name="start"></td>
                        </tr>
                        <tr>
                            <td><label for="">End Year:</label></td>
                            <td><input class="form" type="text" name="end"></td>
                        </tr>
                        <tr>
                            <td><label for="">Level:</label></td>
                            <td><input class="form" type="text" name="lvl" placeholder="Primary, Secondary, Tertiary Etc."></td>
                        </tr>
                        <tr>
                            <td><label for="">Course:</label></td>
                            <td><input class="form" type="text" name="course"></td>
                        </tr>
                        <tr>
                            <td><label for="">Location:</label></td>
                            <td><input class="form" type="text" name="loc" placeholder="School Address"></td>
                        </tr>
                    </table>
                    <div style="padding-left: 90%;">
                        <button class="green-btn" type="submit" name="submit">Add</button>
                    </div>



        <div>
            <br><br><br>
            <div style="display: flex; justify-content: center;">
                <table style="width: 70%;" class="educTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>School Name</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Level</th>
                            <th>Course</th>
                            <th>Location</th>
                            <th style="width: 60px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    $sql = "SELECT * FROM `education`";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['schoolName'] ?></td>
            <td><?php echo $row['yearStart'] ?></td>
            <td><?php echo $row['yearEnd'] ?></td>
            <td><?php echo $row['level'] ?></td>
            <td><?php echo $row['course'] ?></td>
            <td><?php echo $row['location'] ?></td>
            <td style="text-align: right;">
    <a href="del_educ.php?id=<?php echo $row['id'] ?>"><button class="red-btn">Delete</button></a>
</td>
        </tr>
        
    <?php
    }
    ?>
</tbody>


                </table>
            </div>
        </div>
        <br>

    </div>
    </div>
    </div>
            </form>
        </div>
</body>



<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>
