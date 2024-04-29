<nav id="navbar-main" class="navbar is-fixed-top">
    <div class="navbar-brand">
        <a href="#" class="navbar-item mobile-aside-button">
            <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
        </a>
    </div>
    <div class="navbar-brand is-right">
        <a href="#" class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
            <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
        </a>
    </div>
    <div class="navbar-menu" id="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item dropdown has-divider has-user-avatar d-flex align-items-center">
                <a href="#" class="navbar-link">
                    <div class="user-avatar mr-2">
                        <img src="assets/img/d494215b-d2e6-448e-9669-7ad2c8a0a2f4.png" alt="Mahdi Angsa" class="rounded-full">
                    </div>
                    <div class="mr-2">
                    <?php 
                        $result = $connect->query("SELECT * FROM admin_info");
                        while ($row = $result->fetch_assoc()) {
                            echo '<span class="Hero">' . $row["name"] . '</span>';
                        }
                        ?>
                    </div>
                </a>

                    <hr class="navbar-divider">
                    <a href="#" class="navbar-item" onclick="ConfirmLogout();">
                        <span class="icon"><i class="mdi mdi-logout"></i></span>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
                        
<script>
    function ConfirmLogout() {
        var confirmation = confirm("Are you sure?");
        if (confirmation){
            window.location.href = "logout.php";
        } else {

        }
    }
</script>


<aside class="aside is-placed-left is-expanded">
  <div class="aside-tools">
    <div>
      MAHDI <b class="font-black">ANGSA</b>
    </div>
  </div>
  <div class="menu is-menu-main">
    <p class="menu-label">General</p>
    <ul class="menu-list">
      <li class="active">
        <a href="dashboard.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(249, 249, 243, 1);transform: ;msFilter:;"><path d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"></path></svg></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Contents</p>
    <ul class="menu-list">
      <li class="--set-active-tables-html">
        <a href="hero.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(249, 249, 243, 1);transform: ;msFilter:;"><path d="M19.17 2H4.83A1.79 1.79 0 0 0 3 3.8v16.4A1.79 1.79 0 0 0 4.83 22h14.34A1.8 1.8 0 0 0 21 20.2V3.8A1.8 1.8 0 0 0 19.17 2zM20 20.2a.8.8 0 0 1-.81.8H4.83a.79.79 0 0 1-.8-.8V3.8a.79.79 0 0 1 .8-.8h14.34a.8.8 0 0 1 .81.8z"></path><path d="m7.53 19 2.25-2-2.25-2v4zm5.69-9a12 12 0 0 0-3.75.7V5h-2v8.65L8.88 13a12.3 12.3 0 0 1 4.29-1c1 0 1.25.55 1.25 1.05v6h2V13a2.68 2.68 0 0 0-.8-2.1 3.27 3.27 0 0 0-2.4-.9zM13 8.25h2A5.89 5.89 0 0 0 16.47 5h-2A7.17 7.17 0 0 1 13 8.25z"></path></svg></span>
          <span class="menu-item-label">Hero</span>
        </a>
      </li>
      <li class="--set-active-forms-html">
        <a href="about.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(249, 249, 243, 1);transform: ;msFilter:;"><path d="M20 3H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 16H5V5h14v14z"></path><path d="M11 7h2v2h-2zm0 4h2v6h-2z"></path></svg></span>
          <span class="menu-item-label">About</span>
        </a>
      </li>
      <li class="--set-active-tables-html">
        <a href="remarks.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgba(241, 236, 236, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h3v3.767L13.277 18H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14h-7.277L9 18.233V16H4V4h16v12z"></path><path d="M8 9h8v2H8z"></path></svg></span>
          <span class="menu-item-label">Remarks</span>
        </a>
      </li>
      <li class="--set-active-profile-html">
        <a href="skills.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(249, 249, 243, 1);transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg></span>
          <span class="menu-item-label">Skills</span>
        </a>
      </li>
      <li>
        <a href="portfolio.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(249, 249, 243, 1);transform: ;msFilter:;"><path d="M13.337 9h-2.838v3h2.838a1.501 1.501 0 1 0 0-3z"></path><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1.337 12h-2.838v3H8.501V7h4.837a3.498 3.498 0 0 1 3.499 3.499 3.499 3.499 0 0 1-3.5 3.501z"></path></svg></span>
          <span class="menu-item-label">Projects</span>
        </a>
      </li>
      <li>
        <a href="education.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(252, 247, 247, 1);transform: ;msFilter:;"><path d="M19 10V7c0-1.103-.897-2-2-2h-3c0-1.654-1.346-3-3-3S8 3.346 8 5H5c-1.103 0-2 .897-2 2v3.881l.659.239C4.461 11.41 5 12.166 5 13s-.539 1.59-1.341 1.88L3 15.119V19c0 1.103.897 2 2 2h3.881l.239-.659C9.41 19.539 10.166 19 11 19s1.59.539 1.88 1.341l.239.659H17c1.103 0 2-.897 2-2v-3c1.654 0 3-1.346 3-3s-1.346-3-3-3zm0 4h-2l-.003 5h-2.545c-.711-1.22-2.022-2-3.452-2s-2.741.78-3.452 2H5v-2.548C6.22 15.741 7 14.43 7 13s-.78-2.741-2-3.452V7h5V5a1 1 0 0 1 2 0v2h5v5h2a1 1 0 0 1 0 2z"></path></svg></span>
          <span class="menu-item-label">Education</span>
        </a>
      </li>
      <li>
        <a href="contact.php">
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(249, 249, 243, 1);transform: ;msFilter:;"><path d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z"></path></svg></span>
          <span class="menu-item-label">Contact</span>
        </a>
    </ul>
  </div>
</aside>