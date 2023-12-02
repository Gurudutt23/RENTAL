<?php
include_once("./db_con.php"); 
include_once("./header.php");
session_start();
        global $uid;
        $uid= $_SESSION['uid'];
        if(!isset($_SESSION['uid'])){
           header('location:login.php');
        }

        $qry = "SELECT * FROM property_master where uid= '$uid'";
        $qry1 = "SELECT * FROM property_owner where uid= '$uid'";
        $all_detail= $conn->query($qry); 
        $all_detail1= $conn->query($qry1);       

?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link href="nav.css" rel="stylesheet">
  <title>Profile</title>
</head>





<div align='center' class="pro_detail">
  <svg width="100" height="100">
    <circle cx="60" cy="60" r="40" fill="blue" />
  </svg>
  <?php
  
  $row = mysqli_fetch_assoc($all_detail1) ?>
  <div><strong> Name-<?php echo $row['uname']; ?></strong></div>
  <div><strong>Contact-<?php echo $row['contact']; ?></strong></div>
  <div><strong>Emial-<?php echo $row['email']; ?></strong></div>
  
</div>
  <?php while ($row = mysqli_fetch_assoc($all_detail)) {  ?>

  <?php } ?>
  
  <div class="container pt-2 pb-2 text-center">
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#mymodal1" name="up_edit">
    Edit Profile
  </button>

  <div class="modal fade" id="mymodal1">
    <div class="modal-dialog modal-dialog-centered"> <!-- Add class "modal-dialog-centered" to center the modal -->
      <div class="modal-content">

        <!-- model Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form method='post' action="./add_data_con.php">
            <div class="table-responsive"> <!-- Add class "table-responsive" to make the table scrollable on small screens -->
              <table class="table table-bordered table-striped"> <!-- Replace attributes with Bootstrap table classes -->
                <tr>
                  <td>Name</td>
                  <td><input type="text" name="up_name"></td>
                </tr>

                <tr>
                  <td>Contact</td>
                  <td><input type="number" maxlength="10" name="up_cont"></td>
                </tr>

                <tr>
                  <td>Password</td>
                  <td><input type="text" name="up_pass"></td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td><input type="text" name="up_mail"></td>
                </tr>

                <tr>
                  <td><input type="reset" name="up_rest" class="btn btn-warning"></td>
                  <td><input type="submit" name="edit_sub" class="btn btn-info" value="Update"></td>
                </tr>
              </table>
            </div>
          </form>
        </div>
        <!-- modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

  


<div class="container pt-2 pb-2 text-center">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal">
    ADD Your Rental Property
  </button>

  <div class="modal fade" id="mymodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- model Header -->
        <div class="modal-header">
          <h4 class="modal-title">ADD Property Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form method='post' action="./add_data_con.php" enctype="multipart/form-data">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <tr>
                  <td>Location</td>
                  <td><textarea rows="5" cols="40" name="location" minlength="15" maxlength="200" required></textarea></td>
                </tr>

                <tr>
                  <td>Property Type</td>
                  <td>
                    <select name="ptype" class="form-select">
                      <option disabled selected>--select--</option>
                      <option>Bungalow</option>
                      <option>House</option>
                      <option>Flat</option>
                      <option>Hostel</option>
                      <option>Room</option>
                      <option>PG</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Number of Rooms</td>
                  <td><input type="number" min="1" name="room"></td>
                </tr>

                <tr>
                  <td>Room Type</td>
                  <td>
                    <select name="rtype" class="form-select">
                      <option disabled selected>--select--</option>
                      <option>A.C.</option>
                      <option>Cooler</option>
                      <option>Not Provided</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Number of Beds</td>
                  <td><input type="number" min="1" name="nbed"></td>
                </tr>

                <tr>
                  <td>Number of Bathrooms</td>
                  <td><input type="number" min="1" name="nbath"></td>
                </tr>

                <tr>
                  <td>Maximum Occupancy</td>
                  <td><input type="number" min="1" name="noccu"></td>
                </tr>

                <tr>
                  <td>Kitchen</td>
                  <td>
                    Available<input type="Radio" name="kitchen" value="1">
                    Not Available<input type="Radio" name="kitchen" value="0">
                  </td>
                </tr>

                <tr>
                  <td>Parking</td>
                  <td>
                    Available<input type="Radio" name="parking" value="1">
                    Not Available<input type="Radio" name="parking" value="0">
                  </td>
                </tr>

                <tr>
                  <td>Description</td>
                  <td><textarea rows="3" cols="20" name="desc" minlength="10" maxlength="200" required></textarea></td>
                </tr>

                <tr>
                  <td>Upload IMG</td>
                  <td><input type="file" name="image[]" multiple></td>
                </tr>

                <tr>
                  <td>Price</td>
                  <td><input type="number" name="price"></td>
                </tr>
                

                <tr>
                  <td><input type="reset" name="rest" class="btn btn-warning"></td>
                  <td><input type="submit" name="sub" class="btn btn-info" value="upload" ></td>
                </tr>
              </table>
            </div>
          </form>
        </div>
        <!-- modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>


  
  
  
  
  
  
  
  <section id="listings">
    <h2 class="alert alert-info">Your Rental Houses</h2>
    <!-- House Cards -->
  
    <?php
    $i = $_SESSION['uid'];
    $qry2 = "SELECT * from property_master WHERE uid=$i ";

    $all_detail2 = $conn->query($qry2);

    if( mysqli_num_rows($all_detail2) !== 0 ) {
      for ($j=0;$j<mysqli_num_rows($all_detail2);$j++) { 
          
          $row = mysqli_fetch_assoc($all_detail2);
          $imageNames = $row['img'];
          $imageArray = explode(",", $imageNames);
          $imageArray = array_map('trim', $imageArray);
          $pid=$row['pid'];
      ?>
      <div class="cards">
      <div class="house-card">
          <div id="a<?php echo $pid; ?>" class="carousel slide" data-ride="carousel" data-interval="3000">
              <div class="carousel-inner">
                  <?php
                  $i = 0;
                  foreach ($imageArray as $imageName) {
      
                  ?>
                      <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                          <img src="<?php echo './uploads/' . $imageName; ?>" class="img-fluid" style="height: 500px;">
                      </div>
                  <?php
                      $i++;
                  }
                  ?>
              </div>
      
              <!-- Carousel Indicators -->
              <ul class="carousel-indicators">
                  <?php
                  for ($k = 0; $k < count($imageArray); $k++) {
                    
                  ?>
                      <li data-target="#a<?php echo $pid; ?>" data-slide-to="<?php echo $k; ?>" <?php if ($k === 0) echo 'class="active"'; ?>></li>
                  <?php
                  }
                  ?>
              </ul>
      
              <!-- Carousel Controls -->
              <a class="carousel-control-prev" href="#a<?php echo $pid; ?>" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#a<?php echo $pid; ?>" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
              </a>
          </div>
      </div>
      
              <div class="main_details">
                <h3 calss='price'><?php echo $row['price'] ?></h3>
                <p class='loc'><?php echo $row['location'] ?></p>
                <p class='type'><?php echo $row['property_type'] ?></p>
                <a href="./detail_page_owner.php?d= <?php echo $row['pid']; ?>"  class="detail">View Details</a>
              </div>
            </div>
                </div>
    <?php  }} else {
      echo "No Property uploaded";
    } ?>
  
  
  
  </section>
  
  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

 
  
  </html>
                  