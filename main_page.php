<?php 

        include_once("./db_con.php");  
        include_once("./header.php");
        session_start();

if(!isset($_SESSION['uid'])){
   header('location:login.php');
}
        $qry = "select * from property_master ";
        $all_detail= $conn->query($qry);  

        
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>House Rentals</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link href="nav.css" rel="stylesheet">

</head>

<body>
  <!-- Main Content -->
  <main>
    <!-- Landing Page -->
    <section id="home">
      <h2 class="alert alert-info">Find your perfect rental house today!</h2>

      <!-- Search Form -->
      <form id="search-form" method="post">
        <div class="search_btn" >
        <input type="text" placeholder="Location" name='loc_search'>
        <input type="number" placeholder="Max Price" name="price_search" >
        <button type="submit" name="search_sub">Search</button>
        </div>        
      </form>
    </section>

    <!-- House Listings -->
    <section id="listings">
      <h2 class="alert alert-info">Available Houses for Rent</h2>
      <!-- House Cards -->

      <?php
      @$val=$_POST['search_sub'];
while ( $val == 0 and $row = mysqli_fetch_assoc($all_detail)) { 
    $imageNames = $row['img'];
    $imageArray = explode(",", $imageNames);
    $imageArray = array_map('trim', $imageArray);
    $i = 0;
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
            for ($j = 0; $j < count($imageArray); $j++) {
              
            ?>
                <li data-target="#a<?php echo $pid; ?>" data-slide-to="<?php echo $j; ?>" <?php if ($j === 0) echo 'class="active"'; ?>></li>
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
          <a href="./detail_page.php?d= <?php echo $row['pid']; ?>"  class="detail">View Details</a>
        </div>
      </div>
      <?php  }  ?>
          
    </section>
    <div id="about">
    <h5>About Us</h5><br>
    <p class="justified-text">Welcome to RENTAL, your ultimate destination for finding the perfect home rental for your needs. We understand the importance of finding a place that truly feels like home, and that's why we are dedicated to providing a seamless and enjoyable experience for both renters and property owners alike.</p><br>
    <h5>Our Mission</h5><br>
    <p class="justified-text">Our mission is to simplify the home rental process and create a platform that connects renters with their ideal living spaces. Whether you're looking for a cozy apartment, a spacious house, or a shared living arrangement, we've got you covered. We strive to offer a wide selection of rental properties that cater to diverse preferences and budgets.</p>
    <br>
</div>
<hr>

  <footer>
    <p>&copy; 2023 House Rentals. All rights reserved.</p>

  </footer>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>
<?php 
if(isset($_POST['search_sub'])){
  $loc_srch=mysqli_real_escape_string($conn, $_POST['loc_search']);
  $price_srch = intval($_POST['price_search']);
  $qry2="SELECT * FROM property_master WHERE (location LIKE '%$loc_srch%' AND price <$price_srch ) OR (location LIKE '%$loc_srch%' OR price < $price_srch) ORDER BY price ASC;";
  $all_detail2= $conn->query($qry2);  
  ?>


    <!-- House Listings -->
    <section id="listings">
      
      <!-- House Cards -->

      <?php
while ($row2 = mysqli_fetch_assoc($all_detail2)) { 
    $imageNames = $row2['img'];
    $imageArray = explode(",", $imageNames);
    $imageArray = array_map('trim', $imageArray);
    $i = 0;
    $pid=$row2['pid'];
?>
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
            for ($j = 0; $j < count($imageArray); $j++) {
              
            ?>
                <li data-target="#a<?php echo $pid; ?>" data-slide-to="<?php echo $j; ?>" <?php if ($j === 0) echo 'class="active"'; ?>></li>
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
          <h3 calss='price'><?php echo $row2['price'] ?></h3>
          <p class='loc'><?php echo $row2['location'] ?></p>
          <p class='type'><?php echo $row2['property_type'] ?></p>
          <a href="./detail_page.php?d= <?php echo $row2['pid']; ?>"  class="detail">View Details</a>
        </div>
      </div>
      <?php  }  ?>

    </section>

<?php

}

?>

