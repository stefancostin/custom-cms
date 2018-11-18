<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php" ?>
<?php 
    $showSuccessAlert = false;
    $showErrorAlert = false;
    $showServerErrorAlert = false;
    include "./admin/includes/alert.php";
?>
<?php
    if(isset($_POST['submit'])) {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Security - Sanitizing data to prevent SQL injections
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            // Security - Hashing password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Register user in DB
            $sql = "INSERT INTO users (user_username, user_email, user_role, user_password) VALUES ('$username', '$email', 'subscriber', '$password')";
            $register = mysqli_query($connection, $sql);
            // Validating query
            if(!$register) {
                die("QUERY FAILED. " . mysqli_error($connection));
            }
            // Show alert
            if($register) {
                $showSuccessAlert = true;
            } else {
                $showServerErrorAlert = true;
            }
        }   else {
            $showErrorAlert = true;
        }
    }
?>

    <!-- Navigation -->
    <?php include "./includes/navigation.php" ?>
    
    <!-- Validation / Alerts -->
    <section id="alerts">
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-3 col-xs-6">
                    <?php 
                        if($showSuccessAlert) {
                            displaySuccessAlert("User registered"); 
                        }
                        if($showErrorAlert) {
                            $moreContent = "All fields are required.";
                            displayErrorAlert("Registration", $moreContent); 
                        }
                        if($showServerErrorAlert) {
                            $moreContent = "There might be something wrong with the server.";
                            displayErrorAlert("Registration", $moreContent); 
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Register -->
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-4 col-xs-4">
                    <div class="form-wrap">
                        <h3 class="text-center text-dark mb-25">Register</h3>
                        <form action="registration.php" method="post" id="register-form" class="mb-40" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter desired username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Email</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php include "./includes/footer.php" ?>