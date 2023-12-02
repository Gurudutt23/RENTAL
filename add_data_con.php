<?php 
include_once("./db_con.php"); 
session_start();
        global $uid;
        $uid= $_SESSION['uid'];
        if(!isset($_SESSION['uid'])){
           header('location:login.php');
        }

        $qry = "SELECT * FROM property_owner where uid= '$uid'";
        $all_detail= $conn->query($qry);         
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['sub'])){
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $property_type = mysqli_real_escape_string($conn, $_POST['ptype']);
    $no_room = intval($_POST['room']);
    $room_type = mysqli_real_escape_string($conn, $_POST['rtype']);
    $no_bed = intval($_POST['nbed']);
    $no_bath = intval($_POST['nbath']);
    $max_occu = intval($_POST['noccu']);
    $kitchen = mysqli_real_escape_string($conn, $_POST['kitchen']);
    $parking = mysqli_real_escape_string($conn, $_POST['parking']);
    $descr = mysqli_real_escape_string($conn, $_POST['desc']);
    $map=str_replace(" ","+",$location);
    $uid= $_SESSION['uid'];
   print_r($_FILES);
    $all_files = $_FILES['image'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $diectory = "uploads/";
    if (!empty($image_name)) {
        foreach ($image_name as $key => $val) {
            $targetPath = $diectory . $val;
            move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetPath);
        }
    }
    
    $image = implode(",", $image_name); 
    $price = floatval($_POST['price']);
    echo $image;
    $sql = "INSERT INTO property_master (`location`, `property_type`, `no_room`, `room_type`, `no_bed`, `no_bath`, `max_occu`, `kitchen`, `parking`, `descr`, `price`, `img`,`map`,`uid`) VALUES ('$location', '$property_type', $no_room, '$room_type', $no_bed, $no_bath, $max_occu, '$kitchen', '$parking', '$descr', $price,'$image','$map',$uid)";
 
 
 $sql2 = "SELECT pid FROM property_master WHERE (`location`, `property_type`, `no_room`, `room_type`, `no_bed`, `no_bath`, `max_occu`, `kitchen`, `parking`, `descr`, `price`, `img`) = ('$location', '$property_type', $no_room, '$room_type', $no_bed, $no_bath, $max_occu, '$kitchen', '$parking', '$descr', $price, '$image')";
$pid=$conn->query($sql2);



    if ($conn->query($sql) === TRUE) {
        echo"<script>alert('Property Added...');
        window.location.replace('add_data.php');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    }

    if (isset($_POST['edit_sub'])) {

        $uid= $_SESSION['uid'];
        if ($_POST['up_name']){
            $newName = $_POST['up_name'];
            $sql = "UPDATE property_owner SET uname = '$newName' WHERE uid = $uid";
            $conn->query($sql);
        }
        if($_POST['up_cont']){
            $newcont = $_POST['up_cont'];
            $sql = "UPDATE property_owner SET contact = '$newcont' WHERE uid = $uid";
            $conn->query($sql);
        }
        if($_POST['up_pass']){
            $newpass = $_POST['up_pass'];
            $sql = "UPDATE property_owner SET pass = '$newpass' WHERE uid = $uid";
            $conn->query($sql);
        }
        if($_POST['up_mail']){
            $newmail = $_POST['up_mail'];
            $sql = "UPDATE property_owner SET email = '$newmail' WHERE uid = $uid";
            $conn->query($sql);
        }
        
    
        
        
        
        if ($conn->query($sql) === TRUE) {
            echo"<script>alert('Profile Updated');
        window.location.replace('add_data.php');</script>";
            
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }


}



// --  $conn->close();
?>
