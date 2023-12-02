<?php 
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
  .table td p{
    font-size: 50px;
    font-weight: 600;
  }
</style>
</head>
<body>

  <?php while($row=mysqli_fetch_assoc($all_detail)){  ?>
  <main>
    <div >
        <div class="detail_image" class="col-sm-6" ><?php
$imageNames = $row['img'];
$imageArray = explode(",", $imageNames);
$imageArray = array_map('trim', $imageArray);
foreach ($imageArray as $imageName) {
?>
  <img class="col-lg-12-pl-3 col-sm-12 "  src="<?php echo './uploads/' . $imageName; ?>" >
<?php 
}
?>
        </div>
        
        <table class="table table-bordered table-striped">
  <tr>
    <td class="alert alert-info m-2" colspan="2"><p>RENT - <?php echo $row['price'] ?> Per/month</p></td>
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
    <td><?php echo $row['descr']?></td>
  </tr>
  <tr>          
  <td colspan="2" align="center" ><iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $row['map'] ?>&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td></tr>
</table>

    </div>
  </main>
  <?php  }  ?>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>