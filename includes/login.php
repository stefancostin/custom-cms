<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
$credentialsError = '';
if(isset($_POST['login'])) {
    // Storing variables.
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Sanitizing input to prevent SQL injections.
    $username = mysqli_real_escape_string($connection, $username);

    // Getting data from the user with the provided username.
    $sql = "SELECT * FROM users WHERE user_username = '$username'";
    $get_user = mysqli_query($connection, $sql);
    if(!$get_user) {
        die("QUERY FAILED. " . mysqli_error($connection));
    }

    // Getting data of user from DB.
    $result = mysqli_fetch_assoc($get_user);
    $db_password = $result['user_password'];
    $db_username = $result['user_username'];
    $db_firstname = $result['user_firstname'];
    $db_lastname = $result['user_lastname'];
    $db_role = $result['user_role'];

    // Verifying password and passing credentials to session (for use in admin panel)
    if (password_verify($password, $db_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['role'] = $db_role;
        $_SESSION['credentialValidation'] = false;
        $_SESSION['userRoleValidation'] = false;
        header("Location: ../admin/");
    } else {
        $_SESSION['credentialValidation'] = true;
        header("Location: ../index.php");
    }
}