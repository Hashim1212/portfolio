<?php
session_start();
include 'includes/server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $content = $_POST["content"];

    $query = "UPDATE `content-section` SET content = '$content' WHERE id = $id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "Content updated successfully!";
    } else {
        echo "Error updating content: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Admin One Tailwind CSS Admin Dashboard</title>

  <link rel="stylesheet" href="assets/css/main2.css?v=1628755089081">
  <script src="script.js"></script>
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
            <div class="card2">
<section class="is-title-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <ul>
      <li>Admin</li>
      <li>Remarks</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Remarks
    </h1>
  </div>
</section>



<div class="container">
<?php
$query = "SELECT * FROM `content-section`";
$result = mysqli_query($connect, $query);

if ($result) {
    echo "<table>";
    echo "<tr><th></th><th>Website Contents</th><th>Content</th><th>Action</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['section_name']}</td>";
        echo "<td id='content-{$row['id']}'>{$row['content']}</td>";
        echo "<td><button class='green-btn' onclick=\"openModal('content-{$row['id']}', '{$row['id']}')\">Change</button></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Error fetching content sections.";
}
?>


<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Edit Content</h2>
        <form id="editForm">
            <div class="form-group">
                <label for="newValue">New Content:</label>
                <input type="text" id="newValue" class="form-control" placeholder="Enter new content">
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>


<script>
    var modal = document.getElementById("myModal");
    var modalTitle = document.getElementById("modalTitle");
    var cellValue;
    var recordId;

    function openModal(field, id) {
        modal.style.display = "block";
        cellValue = document.getElementById(field).innerText;
        document.getElementById("newValue").value = cellValue;
        modalTitle.innerText = "Edit Content";
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
            if (xhr.status === 200) {
                document.getElementById("content-" + recordId).innerText = newValue;
                closeModal();
            } else {
                console.error("Error updating content:", xhr.responseText);
            }
        }
    };
    var params = "id=" + recordId + "&content=" + encodeURIComponent(newValue);
    xhr.send(params);
}

document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault();
    saveChanges();
});

</script>

</div>
</div>
</div>
</div>
</body>
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  <script type="text/javascript" src="assets/js/chart.sample.min.js"></script>
  <script type="text/javascript" src="assets/js/main2.min.js?v=1628755089081"></script>


</html>
