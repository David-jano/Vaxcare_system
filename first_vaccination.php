<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_SESSION['user_name'])){
  $user_name=$_SESSION['user_name'];
}

// Increment the visitor count in the session
if (!isset($_SESSION['visitors'])) {
    $_SESSION['visitors'] = 1;
} else {
    $_SESSION['visitors']++;
}
?>
 
<?php

if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
  
    $username = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>E-Child Vaxcare</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link rel="stylesheet" href="styles.css"/>
  <!-- Google Fonts Roboto -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />

  <!-- Custom styles -->
  <link rel="stylesheet" href="css/admin.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <link href="images/apple-touch-icon.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php
if (isset($_POST["searchh"])) {
  if(!empty($_POST['patternn'])){
    $patternn = $_POST["patternn"];
    $query = "SELECT * FROM vaccination_data WHERE Child_names LIKE '%$patternn%'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($connection));
    }

if(mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)) {
        $stored_child= $row["Child_names"];
        $stored_igituntu= $row["Igituntu"];
        $stored_igituntu_date= $row["Date_Igituntu"];
        $stored_igituntu_weights= $row["Igituntu_bodyweight"];

        $imbasa1=$row["Imbasa1"];
        $imbasa1_date=$row["Date1"];
        $imbasa1_weights=$row["Imbasa1_weight"];

         $imbasa2=$row["Imbasa2"];
        $imbasa2_date=$row["Date2"];
        $imbasa2_weights=$row["Imbasa2_weight"];

         $imbasa3=$row["Imbasa3"];
        $imbasa3_date=$row["Date3"];
        $imbasa3_weights=$row["Imbasa3_weight"];

        $imbasa4=$row["Imbasa4"];
        $imbasa4_date=$row["Date4"];
        $imbasa4_weights=$row["Imbasa4_weight"];

        $imbasa5=$row["Imbasa5"];
        $imbasa5_date=$row["Date5"];
        $imbasa5_weights=$row["Imbasa5_weight"];
    }
}
else
{
  echo"<script>alert('No information found')</script>";
}
}
else
{
  echo"<script>alert('fill the field first')</script>";
}
}
?>


<?php 
$statement = "SELECT * FROM announcements";
$prepare = mysqli_query($conn, $statement);

$aa=mysqli_num_rows($prepare)>0;

 ?>

<body style="background-color: #f0f0f0;">
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">
      <!-- Main Logo and Title -->
      <div class="list-group-item py-2">
        <div class="d-flex align-items-center">
          <span class="fw-bold">E-Child VaxCare System</span><br>
          <hr>
        </div>
      </div>

    <!-- Dashboard Section -->
      <a href="dashboard.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-tachometer-alt fa-fw me-3" style="color:blue;"></i>Dashboard
      </a>
      <a href="schedule.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-calendar fa-fw me-3" style="color:green;"></i>Vaccination Schedule
      </a>
      <a href="first_vaccination.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-address-book fa-fw me-3" style="color:orange;"></i>Registration
      </a>
      <a href="immunization.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-medkit fa-fw me-3" style="color:indigo;"></i>Immunization
      </a>

      <a href="nutrition.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-chart-line fa-fw me-3" style="color:red;"></i>Nutrition Status
      </a>

      <div class="list-group-item py-2" data-bs-toggle="collapse" data-bs-target="#account-pages">
  <span class="fw-bold dropdown-toggle" >More Information</span>
</div>
<div id="account-pages" class="collapse show">
  <a href="report.php" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-table fa-fw me-3" style="color:#f4ca16;"></i>Reports
  </a>
  <a href="documents.php" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-file fa-fw me-3" style="color:#008080;"></i>Documents
  </a>
  <br>
  &nbsp;&nbsp;<a href="announcements.php" class="ml-3 list-group-item-action py-3">
    <i class="fas fa-bell fa-fw me-2" style="color:#954535; vertical-align: middle;"></i>
    Announcements
    &nbsp;<span class="badge rounded-pill badge-notification bg-danger"><?php echo $aa; ?> New</span>
  </a>
</div>


 
    <div class="dropdown d-flex align-items-center  text-decoration-none fixed-bottom mb-3">
      <hr>
        &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <small class="text-muted">&copy; 2023 Byumba Hospital</small>
    
    </div>

    </div>
  </div>
</nav>






    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="dashboard.php">
          <img src="images/apple-touch-icon.png" height="25" alt="" loading="lazy" />&nbsp;
        </a>
        <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto align-items-center" method="POST">
          <input type="text" class="form-control rounded" placeholder='Search batch' style="min-width: 225px" name="batch_pattern" required />
          <input type="submit" class="input-group-text border-0" value="Search" name='batch_search'>
        </form>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->

          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
              role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <li class="nav-item dropdown">Pediatrician&nbsp;<?php echo $user_name; ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger"><?php echo $aa; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Notifications</a></li>
            </ul>
          </li> &nbsp;&nbsp;&nbsp;

          <!-- Icon -->
          <li class="nav-item">
            <a class="nav-link me-3 me-lg-0" href="#">
              <i class="fas fa-cog"></i>
            </a>
          </li>
          <!-- Icon -->
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="#">
              <i class="fas fa-thermometer"></i>
            </a>
          </li>

          <!-- Icon dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown" role="button"
              data-mdb-toggle="dropdown" aria-expanded="false">
              <i class="united kingdom flag m-0"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
                  <i class="fa fa-check text-success ms-2"></i></a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#"><i class="rwanda flag"></i>Kinyarwanda</a>
              </li>
              <li>
                <a class="dropdown-item" href="#"><i class="france flag"></i>France</a>
              </li>
              
            </ul>
          </li>

          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <div class="d-flex align-items-center">
    <img src="images/avatar.png" class="rounded-circle dropdown-toggle" height="22" alt="user" loading="lazy" />

    <span class="position-relative" style="width:-4px;">
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
            <!-- Status indicator content -->
        </span>
    </span>
</div>

            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item text-success" href="#"><?php echo $user_name; ?>
               <span class="badge rounded-pill text-bg-success">Online</span></li>
              <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">

<!----first section--->
<section>
  <div class="row">

                
<div class="col-xl-4 col-sm-6 col-12 mb-4">
            <div class="card col-12">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    
                    <form method="POST" class="needs-validatation">
                    <div class="input-group">
  <div class="form-outline col-9">
    <input type="text" id="form1" class="form-control" name="pattern" required/>
    <label class="form-label" for="form1">Search child information</label>
  </div>
  <input type="submit" class="btn btn-primary btn-sm" value="Search" name="search" onclick="this.form.classList.add('was-validated')"/>
</div>
 </form>

 <?php
$matchFound = false; // Set it to false initially

if (isset($_POST['search'])) {
    $pattern = $_POST['pattern'];

    $url1 = "http://vaxcaresystem.atwebpages.com/child_api.php";
    $receive_data = file_get_contents($url1);
    $data_decode = json_decode($receive_data, true);

    foreach ($data_decode as $row) {
        $names = $row['Child_name'];
        $Father_name = $row['Father_name'];
        $Mother_name = $row['Mother_name'];
        $Father_id = $row['Father_id'];
        $Mother_id = $row['Mother_id'];

        if (
            $pattern == $names ||
            $pattern == $Father_name ||
            $pattern == $Mother_name ||
            $pattern == $Father_id ||
            $pattern == $Mother_id
        ) {
            $matchFound = true;
            $Mother_phone = $row['Mother_phone'];
            $province = $row['Province'];
            $district = $row['District'];
            $sector = $row['Sector'];
            $cell = $row['Cell'];
            $village = $row['Village'];
            $Father_id = $row['Father_id'];
            $Father_name = $row['Father_name'];
            $Father_phone = $row['Father_phone'];
            $Mother_id = $row['Mother_id'];
            $social = $row['social_economic_categorization'];
            $Mother_name = $row['Mother_name'];
            $child_name = $row['Child_name'];
            $dob = $row['dob'];
            $sex = $row['sex'];
            break;
        }
    }

    if (!$matchFound) {
        echo "<div class='alert alert-danger mt-3'><b>Error: </b>child named " . $pattern . " Not found </div>";
    }
}

?>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

        <div class="card mb-3">

          <div class="card-header py-3 d-flex justify-content-between text-light bg-success">
          <nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item" aria-current="page">
      <span class="page-link bg-success text-light"><i class="fas fa-trash me-1" title="Remove any child info"></i>&nbsp;</span>
    </li>
    <li class="page-item"><a title="Commit Modification to Child Information" class="page-link text-success" href="#navigate top">&nbsp;<i class="fas fa-edit me-1 text-lighy">&nbsp;&nbsp; </i>Modify</a></li>
    <span class="page-link bg-success text-light"><a href="#" data-bs-toggle="modal" data-bs-target="#Toggle2" class="text-light text-decolation-none"><i class="fas fa-binoculars me-1" title="View All Registered Child"></i>&nbsp;View</a></span>
  </ul>
</nav>

<div class="modal fade" id="Toggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"><i class="fas fa-users me-1"></i>&nbsp;Child Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php
// Now, let's retrieve and display the table
$s = "SELECT * FROM vaccination_data";
$q = mysqli_query($conn, $s);

echo "<table class='table table-striped'><tr><th>#</th><th>Batch Number</th><th>Child Names</th><th>DOB</th><th>Sex</th><th>Father Names</th><th>Father ID</th>
<th>Father Phone</th><th>Mother Name</th><th>Mother ID</th><th>Mother Phone</th><th>Province</th><th>District</th><th>Sector</th>
<th>Cell</th><th>Village</th><th>Care Taker</th><th>Pregnancy No</th><th>Twins</th><th>Weight At Birth</th><th>Height At Birth</th><th>Action</th></tr>";

$i = 1;
while ($row = mysqli_fetch_array($q)) {
    $SE = $row['Batchno'];
    echo "<tr><td>" . $i++ . "</td><td>" . $row['Batchno'] . "</td><td>" . $row['Child_names'] . "</td><td>" . $row['Dob'] . "</td><td>" . $row['Sex'] . "</td><td>" . $row['Father_name'] . "</td><td>" . $row['Father_id'] . "</td><td>" . $row['Father_phone'] . "</td><td>" . $row['Mother_name'] . "</td><td>" . $row['Mother_id'] . "</td><td>" . $row['Mother_phone'] . "</td><td>" . $row['Province'] . "</td><td>" . $row['District'] . "</td><td>" . $row['Sector'] . "</td><td>" . $row['Cell'] . "</td><td>" . $row['Village'] . "</td><td>" . $row['Care_taker'] . "</td><td>" . $row['Pregnancy_number'] . "</td><td>" . $row['Twins_or_more'] . "</td><td>" . $row['Weight_at_birth'] . "</td><td>" . $row['Height_at_birth'] . "</td><td>
   
    <a href='update.php?id=$SE' class='btn btn-primary btn-sm'><i class='fas fa-edit text-light'></i></a>
   
    <a href='delete.php?id=$SE' class='btn btn-danger btn-sm'><i class='fas fa-trash text-light'></i></a>

  
    </td></tr>";
}
echo "</table>";
?>

      </div>
    </div>
  </div>
</div>

<strong class="text-light"><i class="fas fa-user me-1 text-light">&nbsp;&nbsp; </i>Personal Information</strong>

<strong><i class="fas fa-user fa-sm text-light"></i>&nbsp;&nbsp;<i class='fas fa-caret-up text-light'></i>&nbsp;&nbsp; <i class='fas fa-times text-light'></i></p></h5></strong>

</div>
          <div class="card-body">
            <form class="row gx-3 gy-2 align-items-center needs-validation" method="POST">
<div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername"></label>
    <div class="input-group">
      <div class="input-group-text">Names</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Child names" name="c_name" value="<?php echo @$child_name; ?>" required readonly/> 
    </div>
    <div class="invalid-feedback">
      Provide child names
    </div>
  </div>

  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
    <div class="input-group">
      <div class="input-group-text">DOB</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Date of birth" name="dob" value="<?php echo @$dob; ?>" readonly required/>
    </div>
  </div>
  
  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
    <div class="input-group">
      <div class="input-group-text">Sex</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Sex" name="sex" value="<?php echo @$sex; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
    <div class="input-group">
      <div class="input-group-text">Father Name</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Father name" name="F_name" value="<?php echo @$Father_name; ?>"  readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
    <div class="input-group">
      <div class="input-group-text">Father ID</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Father Id" name="F_id" value="<?php echo @$Father_id; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Father Phone</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Father Phone" name="F_phone" value="<?php echo @$Father_phone; ?>" required/>
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Mother Name</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Mother name" name="M_name" value="<?php echo @$Mother_name; ?>" readonly required/>
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Mother ID</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Mother Id..." name="M_id" value="<?php echo @$Mother_id; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Mother Phone</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Mother Phone..." name="M_phone" value="<?php echo @$Mother_phone; ?>" readonly required/>
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Province</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Province..." name="Province" value="<?php echo @$province; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">District</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="District..." name="District" value="<?php echo @$district; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Sector</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Sector..." name="Sector"  value="<?php echo @$sector; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Cell</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Cell..." name="Cell" value="<?php echo @$cell; ?>" readonly required/>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Village</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Village..." name="Village" value="<?php echo @$village; ?>" readonly required/>
    </div>
  </div>
<div class="card-header py-3 d-flex justify-content-center text-light bg-success fw-bold"><i class="fas fa-user me-1 text-lighy">&nbsp;&nbsp; </i>Child Profile Information </div>

<div class="col-sm-3">
    <label >Care Taker</label>&nbsp;
      <input type="radio" class="mr-3" name="care" value="Yes" required/> <label>Yes</label> 
      <input type="radio" class="mr-3" name="care" value="No" required/> <label>No</label>  
  </div>
<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Email</div>
      <input type="email" class="form-control" id="specificSizeInputGroupUsername" placeholder="Optional..." name="Pregnancyno" value="" />
    </div>
  </div>

<div class="col-sm-3">
      <label>Twins or More</label> &nbsp;
     <input type="radio" value="Yes"class="mr-3" name="twin" required/> <label>Yes</label> 
     <input type="radio" value="No"class="mr-3" name="twin" required/> <label>No</label> 
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Weights at birth(kgs)</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="kgs..." name="weights" value="" required/>
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Height at Birth(cm)</div>
      <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="cm..." name="height" value="" required/>
    </div>
  </div>

<div class="row mt-3">
<div class="col-auto mt-3">
    <input type="submit" class="btn btn-primary" value="Save Data" name="save" onclick="this.form.classList.add('was-validated')" />
  </div>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['save']) && ($_POST['care']) && ($_POST['twin'])) {
    $child_name = $_POST['c_name'];
    $dob = $_POST['dob'];
    $sex= $_POST['sex'];
    $Father_name =$_POST['F_name'];
    $Father_id =$_POST['F_id'];
    $Father_phone = $_POST['F_phone'];
    $Mother_name = $_POST['M_name'];
    $Mother_id =$_POST['M_id'];
    $Mother_phone = $_POST['M_phone'];
    $province = $_POST['Province'];
    $district = $_POST['District'];
    $sector = $_POST['Sector'];
    $cell = $_POST['Cell'];
    $village = $_POST['Village'];
    $caretaker = $_POST['care'];
    $pregnancyno = $_POST['Pregnancyno'];
    $twin = $_POST['twin']; 
    $weight = $_POST['weights']; 
    $height = $_POST['height']; 

    $batch_number = rand();

    $stmt = "INSERT INTO vaccination_data (Child_names, Dob,Sex, Father_name, Father_id, Father_phone, Mother_name, Mother_id, Mother_phone, Province, District, Sector, Cell, Village, Care_taker, email, Twins_or_more, Weight_at_birth, Height_at_birth, Batchno)
    VALUES ('$child_name', '$dob','$sex', '$Father_name', '$Father_id', '$Father_phone', '$Mother_name', '$Mother_id', '$Mother_phone', '$province', '$district', '$sector', '$cell', '$village', '$caretaker', '$pregnancyno', '$twin', '$weight', '$height', '$batch_number')";
        
        $que=mysqli_query($conn,$stmt);

        if($que) {
            echo "<br><div class='alert alert-success mt-3'><i class='fas fa-user-plus me-1 text-lighy'></i>&nbsp;&nbsp; Your Batch number is <b>" . $batch_number . "</b></div>";
            echo "<script>alert('Data inserted successfully')</script>";
        }
         else

          {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
}
?>

</div>
        </div>

        <div class="row">
        </div>
      </section>

       <?php
if(isset($_POST['batch_search'])){
  $batch_pattern=$_POST['batch_pattern'];
echo "<div class='modal fade' id='exampleModal' >
            <div class='modal-dialog modal-lg modal-dialog-scrollable'>
                <div class='modal-content'>
                    <div class='modal-header bg-secondary text-light'>
                        <h5 class='modal-title' id='editModalLabel'>Found Results for Batch Number"." '".  $batch_pattern."'</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>";
   $query0 = "SELECT * FROM  vaccination_data WHERE Batchno = '$batch_pattern'";
    $result0 = mysqli_query($conn, $query0);
    if (mysqli_num_rows($result0) > 0) {

      echo"<table class='table table-striped'><tr><th>Batchno</th><th>Child Names</th><th>DOB</th><th>Father Name</th><th>Mother Name</th><th>Father ID</th><th>Mother ID</th><th>Family Phone</th><th>Province</th><th>District</th><th>Sector</th><th>Cell</th><th>Village</th></tr>";
        while ($row = mysqli_fetch_assoc($result0)) {
            
      echo"<tr><td>".$batch_pattern."</td><td>".$row['Child_names']."</td><td>".$row['Dob']."</td><td>".$row['Father_name']."</td><td>".$row['Mother_name']."</td><td>".$row['Father_id']."</td><td>".$row['Mother_id']."</td><td>".$row['Father_phone']."</td><td>".$row['Province']."</td><td>".$row['District']."</td><td>".$row['Sector']."</td><td>".$row['Cell']."</td><td>".$row['Village']."</td></tr>

                    </div>
                    <div class='modal-footer'
                    </div>
                </div>
            </div>
        </div>";

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
            </script>";         
}
echo"</table>";
}
else
{
  echo"<script>alert('Invalid Batch Number')</script>";
}
}
        ?>


          </div>
  </main>

<script>
  // Trigger the fade-in animation when the page is loaded or refreshed
  window.addEventListener("load", function () {
    const cardItems = document.querySelectorAll(".card-item");

    cardItems.forEach(function (item) {
      item.style.opacity = "1"; // Set opacity to 1 to trigger the animation
    });
  });
</script>

<script>
        // Automatically logout after 20 seconds of inactivity
        setTimeout(function() {
            window.location.href = 'index.php'; // Redirect to the logout page
        }, 1800000); // 20,000 milliseconds (20 seconds)
    </script>

  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>