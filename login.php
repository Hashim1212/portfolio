    <?php
    session_start();
    include('includes/server.php');
    include('includes/aheader.php');

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = $_POST['email'];
        $password = SHA1($_POST['password']);

        
        $query = 'SELECT * FROM user WHERE email = "' . $email . '" AND password = "' . $password . '"';

        
        $result = mysqli_query($connect, $query);

        
        $record = mysqli_fetch_assoc($result);

        
        if ($record) {
            
            
            
            $_SESSION['email'] = $record['email'];
            $_SESSION['user_id'] = $record['id'];

            
            header("Location: dashboard.php");
            exit(); 
        } else {
            
            
            echo "Invalid email or password. Please try again.";
        }
    }
    ?>
<body style="background-color: #272829;">
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-sm-8 col-md-6 col-lg-4"> <!-- Adjust the column size as needed -->
        <div class="card p-4"> <!-- Adjust padding -->
        <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group mb-4">
        <!-- Email input -->
        <label for="email" class="form-label">e-mail</label>
        <input type="text" id="email" name="email" class="form-control" />
    </div>

    <div class="form-group mb-4">
        <!-- Password input -->
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" />
    </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
        </div>
    </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Log in</button>
            <a href="index.php" class="btn btn-scondary btn-block">Back</a>
</form>
<!-- Form ends here -->
        </div>
        </div>
    </div>
    </div>
</body>
    <?php
    include('../includes/afooter.php');
    ?>
