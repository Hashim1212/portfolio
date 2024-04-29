<?php
session_start();
include ('includes/server.php');
include('includes/header.php');

$query = "SELECT * FROM admin_info";
$result = mysqli_query($connect, $query);

$address = '';
$email = '';
$phone = '';

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $address = $row['address'];
    $email = $row['email'];
    $phone = $row['phone_number'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'includes/server.php';

  if ($connect->connect_error) {
      die("Connection failed: " . $connect->connect_error);
  }

  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
  $message = isset($_POST['message']) ? $_POST['message'] : '';

  $stmt = $connect->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message);


  if ($stmt->execute()) {
      echo "success"; 
  } else {
      echo "error";
  }


}

$latest_cv_query = "SELECT cv_path FROM cv ORDER BY id DESC LIMIT 1";
$latest_cv_result = mysqli_query($connect, $latest_cv_query);


if ($latest_cv_result && mysqli_num_rows($latest_cv_result) > 0) {

    $latest_cv_row = mysqli_fetch_assoc($latest_cv_result);
    $latest_cv_path = $latest_cv_row['cv_path'];
} else {

    $latest_cv_path = ""; 
}

?>

  <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
  <header id="header" class="d-flex flex-column justify-content-center">

  <nav id="navbar" class="navbar nav-menu transparent">
  <ul>
    <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
    <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
    <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
    <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
    <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
  </ul>
</nav>


  </header>

              <?php 
                $result = $connect->query("SELECT * FROM img");
                  if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc(); 
                  $imgSrc2 = $row['img-2']; 
                  }
              ?>

<section id="hero" class="d-flex flex-column justify-content-center" style="<?php if (isset($imgSrc2)) echo "background: url('{$imgSrc2}') top right no-repeat; background-size: cover; height: 100vh;"; ?>">


    <div class="container" data-aos="zoom-in" data-aos-delay="100">
      <h1><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="Hero">' . $row["name"] . '</span>';
                        }
                        ?></h1>
      <p>I'm <span class="typed" data-typed-items="Developer, Designer  "></span></p>
      <div class="social-links">
        <a href="<?php 
                        $result = $connect->query("SELECT * FROM socials WHERE id= 1 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["s_link"] ;
                        }
                        ?>" class="twitter"><?php 
                        $result = $connect->query("SELECT * FROM socials WHERE id= 1 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["s_icons"] ;
                        }
                        ?></a>
        <a href="<?php 
                        $result = $connect->query("SELECT * FROM socials WHERE id= 2 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["s_link"] ;
                        }
                        ?>" class="facebook"><?php 
                        $result = $connect->query("SELECT * FROM socials WHERE id= 2 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["s_icons"] ;
                        }
                        ?></a>
        <a href="<?php 
                        $result = $connect->query("SELECT * FROM socials WHERE id= 3 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["s_link"] ;
                        }
                        ?>" class="instagram"><?php 
                        $result = $connect->query("SELECT * FROM socials WHERE id= 3 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["s_icons"] ;
                        }
                        ?></a>
        <a href="<?php echo $latest_cv_path; ?>" class="twitter"><box-icon name='paperclip'></box-icon></a>

        
      </div>
    </div>
  </section>

  <main id="main">

    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p><?php
    $result = $connect->query("SELECT * FROM `content-section` WHERE id = 1");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["content"];
        }
    } else {
        echo "No content found";
    }
    ?></p>
        </div>

        <div class="row">
    <div class="col-lg-4">
        <?php 
        $result = $connect->query("SELECT * FROM img");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imgSrc1 = $row['img-1'];
                echo "<img src='{$imgSrc1}' class='img-fluid' alt=''>";
            }
        }
        ?>
    </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content">
            <h3><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span>' . $row["work"] . '</span>';
                        }
                        ?></h3>
            <p class="fst-italic">
            <?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span>' . $row["work-desc"] . '</span>';
                        }
                        ?>
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="adminI">' . $row["Birthday"] . '</span>';
                        }
                        ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="adminI">' . $row["phone_number"] . '</span>';
                        }
                        ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Address:</strong><span><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="adminI">' . $row["address"] . '</span>';
                        }
                        ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="adminI">' . $row["age"] . '</span>';
                        }
                        ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="adminI">' . $row["degree"] . '</span>';
                        }
                        ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="adminI">' . $row["email"] . '</span>';
                        }
                        ?></span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section id="facts" class="facts">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Details</h2>
          <p> <?php
    $result = $connect->query("SELECT * FROM `content-section` WHERE id = 2");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["content"];
        }
    } else {
        echo "No content found";
    }
    ?></p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
            <?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 1 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_name"] ;
                        }
                        ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 1 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["count"] ;
                        }
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 1 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_desc"] ;
                        }
                        ?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
            <?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 2 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_name"] ;
                        }
                        ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 2 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["count"] ;
                        }
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 2 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_desc"] ;
                        }
                        ?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
            <?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 3 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_name"] ;
                        }
                        ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 3 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["count"] ;
                        }
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 3 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_desc"] ;
                        }
                        ?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
            <?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 4 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_name"] ;
                        }
                        ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 4 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["count"] ;
                        }
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?php 
                        $result = $connect->query("SELECT * FROM icons WHERE id= 4 ");
                        while ($row = $result->fetch_assoc()) {
                            echo $row["icon_desc"] ;
                        }
                        ?></p>
            </div>
          </div>

        </div>

      </div>
    </section>

  
    <section id="resume" class="resume">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Resume</h2>
          <p><?php
    $result = $connect->query("SELECT * FROM `content-section` WHERE id = 3");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["content"];
        }
    } else {
        echo "No content found";
    }
    ?></p>
        </div>

<?php

$education_data = array(
    array(
        'schoolName' => 'Western Mindanao State University',
        'yearStart' => '2020',
        'yearEnd' => '2024',
        'level' => 'tertiary',
        'course' => 'Bachelor of Science in Information Technology',
        'location' => 'Normal Road, Baliwasan, Zamboanga City'
    ),
    array(
        'schoolName' => 'Talon-Talon National High School',
        'yearStart' => '2018',
        'yearEnd' => '2020',
        'level' => 'secondary',
        'course' => 'Science, Technology, Engineering and Mathematics',
        'location' => 'Candido Drive, Talon-Talon, Zamboanga City'
    )
);


$education_data_row1 = array_slice($education_data, 0, ceil(count($education_data) / 2));
$education_data_row2 = array_slice($education_data, ceil(count($education_data) / 2));

?>

<div class="row">
    <div class="col-lg-6">
        <?php foreach ($education_data_row1 as $education): ?>
            <div class="resume-item">
                <h3 class="resume-title">Education</h3>
                <h4><?php echo $education['schoolName']; ?></h4>
                <h5><?php echo $education['yearStart'] . ' - ' . $education['yearEnd']; ?></h5>
                <p><em><?php echo $education['course']; ?></em></p>
                <ul>
                    <li><?php echo $education['location']; ?></li>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php foreach ($education_data_row2 as $education): ?>
            <div class="resume-item">
                <h3 class="resume-title">Education</h3>
                <h4><?php echo $education['schoolName']; ?></h4>
                <h5><?php echo $education['yearStart'] . ' - ' . $education['yearEnd']; ?></h5>
                <p><em><?php echo $education['course']; ?></em></p>
                <ul>
                    <li><?php echo $education['location']; ?></li>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>






      </div>
    </section>

    <section id="skills" class="skills section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Skills</h2>
          <p> <?php
    $result = $connect->query("SELECT * FROM `content-section` WHERE id = 4");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["content"];
        }
    } else {
        echo "No content found";
    }
    ?></p>
        </div>

        <?php

$query = "SELECT * FROM skills";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {

    echo '<div class="row skills-content">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-lg-6">';
        echo '<div class="progress">';
        echo '<span class="skill">' . $row['skillName'] . ' <i class="val">' . $row['lvl'] . '%</i></span>';
        echo '<div class="progress-bar-wrap">';
        echo '<div class="progress-bar" role="progressbar" aria-valuenow="' . $row['lvl'] . '" aria-valuemin="0" aria-valuemax="100"></div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo 'No skills data found.';
}
?>


      </div>
    </section>


    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p><?php
    $result = $connect->query("SELECT * FROM `content-section` WHERE id = 5");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["content"];
        }
    } else {
        echo "No content found";
    }
    ?></p>
        </div>

        <?php

$result = $connect->query("SELECT * FROM portfolio");


if ($result->num_rows > 0) {
    $rowCount = 0;
    while ($row = $result->fetch_assoc()) {

        if ($rowCount % 3 == 0) {
            echo "<div class='row portfolio-container' data-aos='fade-up' data-aos-delay='200'>";
        }
?>
<div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo isset($row['filter']) ? htmlspecialchars($row['filter']) : ''; ?>">
    <div class="portfolio-wrap">
        <?php if(isset($row['image_src']) && !empty($row['image_src'])): ?>
            <img src="<?php echo htmlspecialchars($row['image_src']); ?>" class="img-fluid" alt="">
        <?php endif; ?>
        <div class="portfolio-info">
            <?php if(isset($row['title'])): ?>
                <h4><?php echo htmlspecialchars($row['title']); ?></h4>
            <?php endif; ?>
            <?php if(isset($row['description'])): ?>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php

        $rowCount++;
        if ($rowCount % 3 == 0) {
            echo "</div>";
        }
    }

    if ($rowCount % 3 != 0) {
        echo "</div>";
    }
} else {

    echo "No portfolio items found.";
}
?>


      </div>
    </section>


    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row mt-1">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Address:</h4>
                <p><?php echo $address; ?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo $email; ?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p><?php echo $phone; ?></p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
    <form action="submit_contact.php" method="post" role="form" class="php-email-form">

<script>

    const form = document.querySelector('.php-email-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        fetch('submit_contact.php', {
            method: 'POST',
            body: new FormData(form)
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Message sent successfully',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    form.reset(); 
                });
            } else {

                Swal.fire({
                  icon: 'success',
                    title: 'Success',
                    text: 'The Message Have Been Sent!'
                });
            }
        })
        .catch(error => {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'The Message Is Not Been Sent!'
            });
        });
    });
</script>

        <div class="row">
            <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit">Send Message</button>
            <div class="success-message" style="color: green; margin-top: 10px;"></div>
        </div>
    </form>
</div>






        </div>

      </div>
    </section>

  </main>

<?php

include('includes/footer.php');

?>