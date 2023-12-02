<?php
global $randomNumber;
include_once 'db_con.php';
$qry = "select * from property_owner;";
$all_detail = $conn->query($qry);
$row = mysqli_fetch_assoc($all_detail);

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';

require 'phpmailer/src/PHPMailer.php';

require 'phpmailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="./reg_log.css">
</head>
<div class="form-container">
  <form method="post">
    Enter You'r Mail ID
    <input type="email" name="email" required placeholder=" Email">
    <input type="submit" name='forgot_submit' value="Enter" class="form-btn">
  </form>
  <br>

  <?php
  session_start();

  if (isset($_POST['forgot_submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $_SESSION['email'] = $email;
    $req_mail = "SELECT  * FROM property_owner WHERE email='$email';";
    $all_mail = $conn->query($req_mail);
    $mail_row = mysqli_fetch_assoc($all_mail);
    $chk=$mail_row['email'];

    if ($chk !== NULL) {
      $_SESSION['random_num'] = random_int(100000, 999999);
      $subject = "Reste Password";
      $message = "One Time Password (OTP) to Reset Password is " .$_SESSION['random_num'] ;
      $mail = new PHPMailer (true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = '' ;//enter your mail id
      $mail->Password = '';// enter your app password
      $mail->SMTPSecure= 'ssl';
      $mail->Port = 465;
      $mail->setFrom('guruduttsahu23@gmail.com'); 
      $mail->addAddress($_POST["email"]);
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $message;
      $mail->send();
      echo"Scroll Down";
  ?>
  </div>
<div class="form-container">
      <form method="post">
        <input type="number" maxlength="6" minlength="6" name="otp">
        <input type="submit" name="otp_sub" value="Verify">
      </form>
</div>

      
    <?php
    } else {
      echo "<script>
            alert('Email Not Register Please Register Your Email');
            document.location.href = 'register.php';
            </script>";
    }
  }
  if (isset($_POST['otp_sub'])) {

    $r = $_SESSION['random_num'];
    $check_otp = intval($_POST['otp']);
    if ($check_otp == $r) { ?>
    <div class="form-container">
      Email Verified....<br>
      <div class="container pt-2">
        <button type="button " class="btn btn-primary" data-toggle="modal" data-target="#mymodal2">
          Reset Password
        </button>


        <div class="modal fade" id="mymodal2">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- model Header -->
              <div class="modal-header">
                <h4 class="modal-title">Reset Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>



              <div class="modal-body">
                <form method='post' enctype="multipart/form-data">


                  <table border="1px" bordercolor="black" max-width="30%" bgcolor="lightyellow" align="center" cellpadding="5px" cellspacing="2px">

                    <tr align="center">
                      <td>New Password</td>
                      <td><input type="text" name="new_pass"> </td>
                    </tr>
                    <tr align="center">
                      <td>Confirm Password</td>
                      <td><input type="text" name="con_new_pass"> </td>
                    </tr>

                    <tr align="center">
                      <td colspan="2"><input type="submit" name="sub_reset" class="btn btn-info" value="Reset"></td>
                    </tr>
                  </table>
                </form>
              </div>
              <!-- modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
      </body>

</html>
<?php

    } else {
      echo "<script>
            alert('Wrong OTP Try Again');
            document.location.href = 'forgot.php';
            </script>";
    }
  }

  if (isset($_POST['sub_reset'])) {
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $gmail = $_SESSION['email'];
    $qry1 = "UPDATE property_owner SET pass = '$newPassword' WHERE email = '$gmail';";
    $all_detail1 = $conn->query($qry1);
    echo "<script>
            alert('Password Updated');
            document.location.href = 'login.php';
            </script>";
  }
?>