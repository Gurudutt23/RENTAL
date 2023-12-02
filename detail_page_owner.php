<?php 
session_start();
        $t=$_GET['d'];
        include_once("./db_con.php");  
        include_once("./header.php");
        $qry = "select * from property_master where pid='$t' ";
        $all_detail= $conn->query($qry);       
        
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="detail.css" rel="stylesheet" >
    <style>
  /* Custom CSS to make table text bolder */
  .table td {
    font-weight:600;
    font-size: x-large;
  }
  .table th p{
    font-size: 50px;
    font-weight: 600;
  }
  
</style>
</head>
<body>
  <?php while($row=mysqli_fetch_assoc($all_detail)){  ?>
  <main>
    <div>
        <div class="detail_image" class="col-sm-6" >
        <?php
$imageNames = $row['img'];
$imageArray = explode(",", $imageNames);
$imageArray = array_map('trim', $imageArray);
foreach ($imageArray as $imageName) {
?>
  <img class=" col-sm-12 " src="<?php echo './uploads/' . $imageName; ?>" >
<?php 
}
?>
        </div>
        
        <table class="table table-bordered table-striped">
  <tr>
    <th class="alert alert-info m-2" colspan="2"><p>RENT - <?php echo $row['price'] ?> Per/month</p></th>
  </tr>
  <tr>
    <td>Property Type</td>
    <td><?php echo $row['property_type'] ?></td>
  </tr>
  <tr>
    <td>Number Of Room</td>
    <td><?php echo $row['no_room'] ?></td>
  </tr>
  <tr>
    <td>Location</td>
    <td><?php echo $row['location'] ?></td>
  </tr>
  <tr>
    <td>Number of Bed Provided</td>
    <td><?php echo $row['no_bed'] ?></td>
  </tr>
  <tr>
    <td>Number of Bathroom</td>
    <td><?php echo $row['no_bath'] ?></td>
  </tr>
  <tr>
    <td>Maximum Occupies</td>
    <td><?php echo $row['max_occu'] ?></td>
  </tr>
  <tr>
    <td>Kitchen</td>
    <td><?php echo ($row['kitchen'] == 1) ? "Available" : "Not Available"; ?></td>
  </tr>
  <tr>
    <td>Parking</td>
    <td><?php echo ($row['parking'] == 1) ? "Available" : "Not Available"; ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><?php echo $row['descr'] ?></td>
  </tr>
  <td colspan="2" align="center" ><iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $row['map'] ?>&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td></tr>
</table>

    <!-- my modal  2 = update -->
    <div class="col-md-12 d-flex justify-content-center my-3">
      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#mymodal2">
        Update
      </button>
    </div>
  
  
      <div class="modal fade" id="mymodal2">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
  
            <!-- model Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update Property Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
  
  
  
            <div class="modal-body">
              <form method='post' enctype="multipart/form-data">
  
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
  
                  <tr align="center">
                    <td>Location</td>
                    <td><textarea rows="5 " cols="40" name="location" minlength="15" maxlength="200" ></textarea></td>
                  </tr>
  
                  <tr align="center">
                    <td>Property Type</td>
                    <td><select name="ptype" required>
                        <optgroup>
                          <option disabled selected>--select--</option>
                          <option>Bangalow</option>
                          <option>House</option>
                          <option>Flat</option>
                          <option>Hostel</option>
                          <option>Room</option>
                          <option>PG</option>
                        </optgroup>
  
                  <tr align="center">
                    <td>Number of Rooms</td>
                    <td><input type="number" min="1" name="room"></td>
                  </tr>
                  <tr align="center">
                    <td>Room Type</td>
                    <td><select name="rtype" required>
                        <optgroup>
                          <option disabled selected>--select--</option>
                          <option>A.C.</option>
                          <option>Cooler</option>
                          <option>Not Provided</option>
                        </optgroup>
                  <tr align="center">
                    <td>Number of Bed</td>
                    <td><input type="number" min="1" name="nbed"></td>
                  <tr align="center">
                    <td>Number of Bathrooms</td>
                    <td><input type="number" min="1" name="nbath"></td>
                  <tr align="center">
                    <td>Maximum Occupies</td>
                    <td><input type="number" min="1" name="noccu"></td>
                  <tr align="center">
                    <td>Kitchen</td>
                    <td>Available<input type="Radio" name="kitchen" value="1" required>
                      Not Available<input type="Radio" name="kitchen" value="0"required></td>
                  <tr align="center">
                    <td>Parking</td>
                    <td>Available<input type="Radio" name="parking" value="1" required>
                      Not Available<input type="Radio" name="parking" value="0" required></td>
                  <tr align="center">
                    <td>Description</td>
                    <td><textarea rows="3 " cols="20" name="desc" minlength="10" maxlength="200"></textarea></td>
                  </tr>
                  <tr align="center">
                    <td>Upload IMG</td>
                    <td><input type="file" name="image[]" multiple class="form-control"></td>
  
                  </tr>
                  <tr align="center">
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
                  <tr align="center">
                    <td><input type="reset" name="rest" class="btn btn-warning"></td>
                    <td><input type="submit" name="sub_upd" class="btn btn-info" value="Update"></td>
                  </tr>
                </table>
              </div>
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
  
    <!-- Delete button -->
    <div class="col-md-12 d-flex justify-content-center my-3">
      <button type="button" class="btn btn-danger btn-block  " data-toggle="modal" data-target="#del_btn" name="del">
        Delete
      </button>
    </div>
  </div>

    <div class="modal fade" id="del_btn">
      <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">

          <!-- model Header -->
          <div class="modal-header">
            <h4 class="modal-title">DELETE</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>



          <div class="modal-body">
            <form method='post' >
            <div class="table-responsive">

              <table class="table table-bordered table-striped">

                <tr align="center" >
                    <td colspan="2">Do You Really Want To Delete ???</td>
                  </tr>

                
                  <tr align="center">
                  <td><button type="button" class="btn btn-success" data-dismiss="modal">Cancle</button></td>
                    <td><input type="submit" name="del_btn" class="btn btn-danger" value="DELETE"></td>
                    
                  </tr>
                </table>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </main>
  <?php  }  ?>
  <footer>
    <span>&copy; 2023 House Rentals. All rights reserved.</span>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
<?php 
if (isset($_POST['sub_upd'])) {
    $uid= $_SESSION['uid'];
    $pid=$_GET['d'];
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
    $uid= $_SESSION['uid'];
    $price = floatval($_POST['price']);
    
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

$dataarr = array($location, $property_type, $no_room, $room_type, $no_bed, $no_bath, $max_occu, $kitchen, $parking, $descr, $price,$image);
$col_arr = array('location', 'property_type', 'no_room', 'room_type', 'no_bed', 'no_bath', 'max_occu', 'kitchen', 'parking', 'descr', 'price','img');

for ($i = 0; $i < 12; $i++) {
    if ($dataarr[$i]) {
        $up_qry = "UPDATE property_master SET $col_arr[$i] = '$dataarr[$i]' WHERE pid = '$t';";
        if ($conn->query($up_qry) === TRUE) {
            echo "<script>alert('Property Edited');
            window.location.replace('add_data.php');
            </script>"; 
        } else {
            echo "Error: " . $up_qry . "<br>" . $conn->error;
        }
    }
}

}
 


if (isset($_POST['del_btn'])) {
    
   
    $qryy = "DELETE FROM property_master WHERE pid = $t;";
    echo $t;
    if ($conn->query($qryy)) {

        echo "<script>alert('Property Deleted');
        window.location.replace('add_data.php');</script>";
    } else {
       
        echo "<script>alert('Property Deletion Failed');</script>";
    }
}

 ?>