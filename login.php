<?php
include_once 'db_con.php';

session_start();
if (isset($_POST['login_submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $select = "SELECT * FROM property_owner WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['pass']) {
            $_SESSION['uid'] = $row['uid'];
            header('location: main_page.php' );
            exit();
        } else {
            $error[] = 'Incorrect password';
        }
    } else {
        $error[] = 'Email not found';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="reg_log.css">
</head>

<body>

    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="login_submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
            
            <p>Forgot Password??? <a href="forgot.php">Forgot</a></p>
        </form>
    </div>

</body>

</html>