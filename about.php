<?php
session_start();
include 'includes/server.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

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
                header("Location: icons.php");
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
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HASHIM MAHDI ANGSA</title>
<script src="https://kit.fontawesome.com/d764c1f087.js" crossorigin="anonymous"></script>
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="assets/css/main2.css?v=1628755089081">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>
  <script src="script.js"></script>
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
      <li>About</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      About
    </h1>
  </div>
</section>

<div class="container">
<?php
$query = "SELECT * FROM admin_info";
$result = mysqli_query($connect, $query);
if ($result) {
    echo "<table>";
    echo "<tr><th>Field</th><th>Value</th><th>Action</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $field => $value) {
            if ($field !== 'id' && $field !== 'work-desc') {
                echo "<tr>";
                echo "<td>$field</td>";
                echo "<td id='$field'>$value</td>";
                echo "<td><button class='green-btn' onclick=\"openModal('$field', '{$row['id']}')\">Change</button></td>"; // Changed button class to 'green-btn'
                echo "</tr>";
            }
        }

        echo "<tr>";
        echo "<td>work-desc</td>";
        echo "<td id='work-desc'>{$row['work-desc']}</td>";
        echo "<td><button class='green-btn' onclick=\"openModal('work-desc', '{$row['id']}')\">Change</button></td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle"></h2>
        <div class="form-group">
            <label for="newValue">New Value:</label>
            <input type="text" id="newValue" class="form-control" placeholder="Enter new value">
        </div>
        <div class="btn-container">
            <button class="btn btn-primary" onclick="saveChanges()">Save</button>
            <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var modalTitle = document.getElementById("modalTitle");
    var cellValue;
    var fieldToUpdate;
    var recordId;

    function openModal(field, id) {
        modal.style.display = "block";
        cellValue = document.getElementById(field).innerText;
        document.getElementById("newValue").value = cellValue;
        modalTitle.innerText = "Edit " + field;
        fieldToUpdate = field;
        recordId = id;
    }

    function closeModal() {
        modal.style.display = "none";
    }

    function saveChanges() {
        var newValue = document.getElementById("newValue").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200 && xhr.responseText === "success") {
                    document.getElementById(fieldToUpdate).innerText = newValue;
                    closeModal();
                } else {
                    document.getElementById(fieldToUpdate).innerText = newValue;
                    closeModal();
                }
            }
        };
        var params = "id=" + recordId + "&field=" + fieldToUpdate + "&newValue=" + newValue;
        xhr.send(params);
    }
</script>
</div>
</div>
</div>
</div>
</body>






<body class="edtpage">
    <div class="container">
        <div>
            <div class="card2">
                <h3 class="edtitle"></h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Icon Name</th>
                        <th>Icon Description</th>
                        <th>Count</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM icons";
                    $result = mysqli_query($connect, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['icon_name']; ?></td>
                                <td><?php echo $row['icon_desc']; ?></td>
                                <td><?php echo $row['count']; ?></td>
                                <td>
                                    <button class="green-btn" onclick="confirmEdit(<?php echo $row['id']; ?>)">Edit</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No icons found.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmEdit(iconId) {
            Swal.fire({
                title: 'Edit Icon?',
                text: 'Are you sure you want to edit this icon?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, edit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `edit_icon.php?id=${iconId}`;
                }
            });
        }
    </script>
</body>

<body class="edtpage">
    <div class="container">
        <div>
            <div class="card2">
                <h3 class="edtitle">Edit Icons and Links</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Icon Name</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM socials";
                    $result = mysqli_query($connect, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['s_icons']; ?></td>
                                <td><?php echo $row['s_link']; ?></td>
                                <td>
                                    <button class="green-btn" onclick="confirmEdit(<?php echo $row['id']; ?>)">Edit</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>No icons found.</td></tr>";
                    }
                    ?>
                </table>
            </div>

            
<div class="card2">
    <h3 class="edtitle">Current CV</h3>
    <?php
    $cv_query = "SELECT cv_path FROM cv ORDER BY id DESC LIMIT 1";
    $cv_result = mysqli_query($connect, $cv_query);
    
    if ($cv_result && mysqli_num_rows($cv_result) > 0) {
        $cv_row = mysqli_fetch_assoc($cv_result);
        $cv_path = $cv_row['cv_path'];
    ?>
        <a href="<?php echo $cv_path; ?>" target="_blank">View Current CV</a>
    <?php
    } else {
        echo "No CV found.";
    }
    ?>
    <h3 class="edtitle">Upload New CV</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="new_cv_file" accept=".pdf">
        <button type="submit" name="upload_cv" class="green-btn">Upload New CV</button>
    </form>
    <?php
  
    if(isset($_POST['upload_cv'])) {

        if(isset($_FILES['new_cv_file'])) {
            $file_name = $_FILES['new_cv_file']['name'];
            $file_tmp = $_FILES['new_cv_file']['tmp_name'];

            $upload_directory = "assets/uploads/";
            $target_file = $upload_directory . basename($file_name);
            
            if(move_uploaded_file($file_tmp, $target_file)) {

                $insert_query = "INSERT INTO cv (cv_path) VALUES ('$target_file')";
                $insert_result = mysqli_query($connect, $insert_query);

                if($insert_result) {
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error inserting CV file path into the database.";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "No file uploaded.";
        }
    }
    ?>
</div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmEdit(Id) {
            Swal.fire({
                title: 'Edit Icon?',
                text: 'Are you sure you want to edit this icon?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, edit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `editsocials.php?id=${Id}`;
                }
            });
        }
    </script>
</body>






<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
<script type="text/javascript" src="assets/js/chart.sample.min.js"></script>
<script type="text/javascript" src="assets/js/main2.min.js?v=1628755089081"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <script src="assets/js/main.js"></script>
  <script src="assets/js/mdb.es.min.js"></script>
</body>
</html>
