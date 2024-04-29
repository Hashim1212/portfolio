<?php
session_start();
include 'includes/server.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];

    $sql = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $messageId);

    if ($stmt->execute()) {
        http_response_code(200);
        exit;
    } else {
        http_response_code(500);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
    <div class="edtpage container">
        <div class="card1">
            <section class="is-title-bar">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                    <ul>
                        <li>Admin</li>
                        <li>Contact</li>
                    </ul>
                </div>
            </section>

            <section class="is-hero-bar">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                    <h1 class="title">Contact</h1>
                </div>
            </section>
            <div class="container">
                <?php
                $query = "SELECT * FROM admin_info";
                $result = mysqli_query($connect, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Action</th></tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $field => $value) {
                            if ($field === 'address' || $field === 'email' || $field === 'phone_number') {
                                echo "<tr>";
                                echo "<td>$field</td>";
                                echo "<td id='$field'>$value</td>";
                                echo "<td><button class='green-btn' onclick=\"openModal('$field', '{$row['id']}')\">Change</button></td>"; // Changed button class to 'green-btn'
                                echo "</tr>";
                            }
                        }
                    }

                    echo "</table>";
                }
                ?>
            </div>

            <div class="container">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date and Time sent</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
                    $result = mysqli_query($connect, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["subject"] . "</td>";
                            echo "<td class='message-column'>" . $row["message"] . "</td>"; 
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td><button class='red-btn' onclick='deleteMessage(" . $row["id"] . ")'>Delete</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No messages found</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    
    <script>
        function deleteMessage(messageId) {
            if (confirm('Are you sure you want to delete this message?')) {
                fetch('delete_messages.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'message_id=' + messageId,
                })
                    .then(response => {
                        if (response.ok) {
                            const deletedRow = document.querySelector('tr[data-id="' + messageId + '"]');
                            deletedRow.remove();
                            location.reload();
                        } else {
                            console.error('Failed to delete message');
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        location.reload();
                    });
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <script type="text/javascript" src="assets/js/chart.sample.min.js"></script>
    <script type="text/javascript" src="assets/js/main2.min.js?v=1628755089081"></script>
</div>
</body>
</html>
