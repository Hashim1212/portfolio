<?php
session_start();
include 'includes/server.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

$query = "SELECT COUNT(*) AS message_count FROM contact_messages";

$result = $connect->query($query);

$messageCount = 0;

if ($result) {
    $row = $result->fetch_assoc();
    $messageCount = $row['message_count'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_id'])) {
  $messageId = $_POST['message_id'];

  $sql = "DELETE FROM contact_messages WHERE id = ?";
  $stmt = $connect->prepare($sql);
  $stmt->bind_param("i", $messageId);

  if ($stmt->execute()) {
-      http_response_code(200);
  } else {
      http_response_code(500);
      exit; 
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

<section class="is-title-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <ul>
      <li>Admin</li>
      <li>Dashboard</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Dashboard
    </h1>
  </div>
</section>

<section class="section main-section">
  <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Messages
            </h3>
            <h1>
            <?php echo $messageCount; ?>
            </h1>
          </div>
          <span class="icon widget-icon text-green-500"><svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24" style="fill: rgba(14, 14, 14, 1);transform: ;msFilter:;"><path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path></svg></span>
        </div>
      </div>
    </div>
  </div>
  <div class="card has-table">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
        Messages
      </p>
      <a href="#" class="card-header-icon">
        <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
    </header>
    <div class="card-content">
      <table>
        <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>e-mail</th>
          <th>subject</th>
          <th>Date</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <?php
    $query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No messages found</td></tr>";
    }
    ?>
             
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

</div>

<script type="text/javascript" src="assets/js/main2.min.js?v=1628755089081"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script type="text/javascript" src="assets/js/chart.sample.min.js"></script>


<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '658339141622648');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1"/></noscript>

<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>
