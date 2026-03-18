<?php
session_start();

if(isset($_SESSION['user_name'])){
  $user_name=$_SESSION['user_name'];
}

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
   <link rel="stylesheet" href="admin_style.css" />

     <!-- bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <!-- google fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- site icons -->
  <link href="images/apple-touch-icon.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- external calendar link-->
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
</head>

<body style="background-color: #f0f0f0;">
 
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

      <!-- Admin Dashboard Section -->
      <a href="Admin.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-tachometer-alt fa-fw me-3" style="color:blue;"></i>Dashboard
      </a>
      <a href="admin_user_management.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-users fa-fw me-3" style="color:green;"></i>User Manager
      </a>
       <a href="admin_documents.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-file fa-fw me-3" style="color:orange;"></i>Documents
      </a>
      <a href="admin_announce.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-bell fa-fw me-3" style="color:red;"></i>Announce
      </a>

      <div class="list-group-item py-2" data-bs-toggle="collapse" data-bs-target="#account-pages">
  <span class="fw-bold dropdown-toggle" >ACCOUNT PAGES</span>
</div>
<div id="account-pages" class="collapse show">
  <a href="#" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-user fa-fw me-3" style="color:cyan;"></i>Profile Info
  </a>
  <a href="Index.php" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-sign-in-alt fa-fw me-3" style="color:indigo;"></i>Sign out
  </a>
  <br>
  &nbsp;&nbsp;
</div>
    <div class="dropdown d-flex align-items-center  text-decoration-none fixed-bottom mb-3">
      <hr>
        &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <small class="text-muted">&copy; 2023 Byumba Hospital</small>
    
    </div>

    </div>
  </div>
</nav>
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
          <input autocomplete="off" type="search" class="form-control rounded"
            placeholder='Search' style="min-width: 225px" />
          <input type="submit" class="input-group-text border-0" value="Search">
        </form>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->

          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
              role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <li class="nav-item dropdown">Admin&nbsp;<?php echo $user_name; ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">
               <?php
echo $_SESSION['visitors'];
    
?>

              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Site Views</a></li>
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
 


  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">

<!----first section--->
<section>
  <div class="row">
<div class="col-xl-3 col-sm-6 col-12 mb-4">
               <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-warning">
                      <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
        $sql = "SELECT * FROM users WHERE Role='Pediatrician'";
    $mquery = mysqli_query($conn, $sql);

   $localUsers=mysqli_num_rows($mquery);
   // Define the maximum value for the progress bar
                $maxValue = 100;

                // Calculate the percentage for the progress bar
                $percentage = ($localUsers / $maxValue) * 100;

                echo '<h3 class="text-danger">' . $localUsers . '</h3>';

      

?></h3>
                    <p class="mb-0">Local Users </p>

                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-users text-warning fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                     <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $localUsers; ?>"
                    aria-valuemin="0" aria-valuemax="<?php echo $maxValue; ?>"></div>
                  </div>
                </div>
                <br>
                <a href="" class="btn btn-outline-warning btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModalview">View All local users</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">
<?php
        $sql = "SELECT * FROM users WHERE Role='Admin'";
    $mquery = mysqli_query($conn, $sql);

   $admins=mysqli_num_rows($mquery);
   // Define the maximum value for the progress bar
                $maxValue = 100;

                // Calculate the percentage for the progress bar
                $percentage = ($admins / $maxValue) * 100;

                echo '<h3 class="text-danger">' . $admins . '</h3>';
?>
                    </h3>
                    <p class="mb-0">Admin Users</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-user text-success fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $admins; ?>"
                    aria-valuemin="0" aria-valuemax="<?php echo $maxValue; ?>"></div>
                  </div>
                </div>
                <br>
                <button class="btn btn-outline-success btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#exampleMod"><i class="fas fa-user-plus me-1"></i>&nbsp;Add User
                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="" class="btn btn-outline-primary btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#adminupdate"><i class="fas fa-user-plus me-1"></i>&nbsp;Manage</a>
              </div>
            </div>
          </div>
          

<div class="modal fade" id="adminupdate" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-light">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Admin Credentials</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        // Now, let's retrieve and display the table
        $s = "SELECT * FROM users WHERE Username='$user_name'";
        $q = mysqli_query($conn, $s);

        echo "<table class='table table-striped'><tr><th>#</th><th>ID</th><th>Username</th><th>Password</th><th>Action</th></tr>";

        if (mysqli_num_rows($q) > 0) {
          $i = 1;
          while ($row = mysqli_fetch_array($q)) {
            $userId = $row['ID']; // Get the user ID
            $usernames = $row['Username'];
            // Display the "Reset my Password" button with a data attribute to store the user ID
            echo "<tr><td>" . $i++ . "</td><td>" . $row['ID'] . "</td><td>" . $row['Username'] . "</td><td>" . $row['Password'] . "</td><td>" . "
              <a href='#' class='btn btn-primary btn-sm reset-password' data-bs-toggle='modal' data-bs-target='#exampleModalToggle2' data-userid='$userId'><i class='fas fa-trash text-light'>&nbsp;&nbsp;</i>Reset my Password</a></td><tr>";
          }
          echo "</table>";
        } else {
          echo "<script>alert('User was Not Found')</script>";
        }
        ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-light">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Provide new Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <form method="POST" >
                   
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username..." name="username" value="<?php echo $usernames; ?>" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="New Strong Password..." name="password" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="retype">Re-Type Password</label>
                        <input type="password" class="form-control" placeholder="re-type Password..." name="re_password" required/>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-outline-secondary form-control" value="Reset Now" name="resetuser">
                </form>

<?php

if (isset($_POST['resetuser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    if (empty($username) || empty($password) || empty($re_password)) {
        echo "All fields are required.";
    } elseif ($password !== $re_password) {
        echo "Passwords do not match.";
    } else {
        // Hash the password for security (use a strong hashing algorithm like bcrypt)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Build the SQL query
        $sql = "UPDATE users SET Password='$hashedPassword' WHERE Username='$username'";
        $res=mysqli_query($conn,$sql);
        if($res==true){
          echo"<script>alert('Reset successfully')</script>";
        }else{
          echo"<script>alert('failed Reset successfully')</script>";
        }
        }}
?>

      </div>
    </div>
  </div>
</div>

<!-- Administrator creation -->
<div class="modal fade" id="exampleMod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-light">
        &nbsp;<h1 class="modal-title fs-5" id="exampleModalLabel"><p style="font-family:roboto;"><i class="fas fa-user-plus me-1"></i>&nbsp;Create New Administrator User</p></h1>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<form method="POST" class="needs-validation">
                   <div class="form-group mb-2">
                        <label for="username">ID</label>
                        <input type="text" class="form-control" placeholder="Username..." name="id" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username..." name="username" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="New Strong Password..." name="password" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="retype">Re-Type Password</label>
                        <input type="password" class="form-control" placeholder="re-type Password..." name="re_password" required/>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-outline-secondary form-control" value="Make Admin Now" name="reg" onclick="this.form.classList.add('was-validated')">
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

if (isset($_POST['reg'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $re_pass = $_POST['re_password'];
    $id = $_POST['id'];

    // Check if passwords match
    if ($pass === $re_pass) {
        // Check password strength (at least 8 characters, with at least one uppercase letter, one lowercase letter, one digit, and one special character)
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass)) {
            // Check if the user ID already exists in the users table
            $checkUserQuery = "SELECT * FROM users WHERE ID = '$id'";
            $userResult = mysqli_query($conn, $checkUserQuery);

            if (mysqli_num_rows($userResult) > 0) {
                echo "<script>alert('User ID already used')</script>";
            } else {
                // Check if the user is in the employees table and their ID starts with "BHP"
                $checkEmployeeQuery = "SELECT * FROM employees WHERE ID = '$id' AND ID LIKE 'BHP%'";
                $employeeResult = mysqli_query($conn, $checkEmployeeQuery);

                if (mysqli_num_rows($employeeResult) > 0) {
                    // Hash the password
                    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

                    // Insert data into the database
                    $Insert_admin = "INSERT INTO users (ID, Username, Password, Role) 
                                     VALUES ('$id', '$user', '$hashedPassword', 'Admin')";
                    $queryInsert = mysqli_query($conn, $Insert_admin);

                    // Check if the query was successful
                    if ($queryInsert) {
                        echo "<script>alert('Admin User Created successfully')</script>";
                    } else {
                        echo "<script>alert('Admin User Creation failed: " . mysqli_error($conn) . "')</script>";
                    }
                } else {
                    echo "<script>alert('No IT User with Provided code found in employees')</script>";
                }
            }
        } else {
            echo "<script>alert('Password is not strong enough')</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match')</script>";
    }
}
?>



      </div>
    </div>
  </div>
</div>

<!-- Local Users view all Modal -->
<div class="modal fade" id="exampleModalview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-light">
        &nbsp;<h1 class="modal-title fs-5" id="exampleModalLabel"><p style="font-family:roboto;"><i class="fas fa-users me-1"></i>&nbsp;List of All Local Users</p></h1>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Now, let's retrieve and display the table
$sql = "SELECT * FROM users WHERE Role='Pediatrician'";
$querying = mysqli_query($conn, $sql);

echo "<table class='table table-striped'><tr><th>#</th><th>ID</th><th>Username</th><th>Password</th><th>Action</th></tr>";

if (mysqli_num_rows($querying) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($querying)) {
        echo "<tr><td>".$i++."</td><td>". $row['ID']."</td><td>".$row['Username']."</td><td>". $row['Password']."</td><td>
        <a href='pediatrician_delete.php?id=".$row['ID']."' class='btn btn-danger btn-sm' onClick=\"return confirm('Are you sure you want to delete this User?');\"><i class='fas fa-trash text-light'>&nbsp;&nbsp;</i>Delete User</a></td><tr>";
    }

}
echo "</table>";
?>
      </div>
    </div>
  </div>
</div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
    <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between px-md-1">
            <div>
              <?php
                $sql = "SELECT * FROM employees WHERE ID LIKE 'BH0%'";
                $myquery = mysqli_query($conn, $sql);

                $totalPediatricianists = mysqli_num_rows($myquery);

                // Define the maximum value for the progress bar
                $maxValue = 100;

                // Calculate the percentage for the progress bar
                $percentage = ($totalPediatricianists / $maxValue) * 100;

                echo '<h3 class="text-danger">' . $totalPediatricianists . '</h3>';
                echo '<p class="mb-0">Total Pediatricianists</p>';
                ?>
            </div>
            <div class="align-self-center">
                <i class="fas fa-user-md text-danger fa-3x"></i>
            </div>
        </div>
        <div class="px-md-1">
            <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $totalPediatricianists; ?>"
                    aria-valuemin="0" aria-valuemax="<?php echo $maxValue; ?>"></div>
            </div>
        </div>
        <br>
        <button class="btn btn-outline-danger btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-list-alt text-danger">&nbsp;</i>View All </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <button class="btn btn-outline-secondary btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModaladd"><i class="fas fa-user-plus text-secondary">&nbsp;</i>Add new </button>
    </div>
</div>
</div>

<!-- Add new Pediatricianists Modal -->
<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-light">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><p style="font-family:roboto;"><i class="fas fa-user-plus text-light">&nbsp;&nbsp;</i>Add New Pediatrician</p></h1>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" class="needs-validation">
                    <div class="form-group mb-2">
                        <label for="id">ID</label>
                        <select name="id" class="form-control" required/>
                          <option>Choose Pediatrician Id
    <?php
    for ($i = 1; $i <=20; $i++) {
        $formattedId = sprintf("BH%03d", $i); 
        echo "<option value='$formattedId'>$formattedId</option>";
    }
    ?>
             </option>
                 </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="names">Names</label>
                        <input type="text" class="form-control" placeholder="names..." name="names" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" placeholder="age..." name="age" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="qualification">Qualification</label>
                        <input type="text" class="form-control" placeholder="qualification..." name="qualification" required/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="martialStatus">Martial Status</label>
                        <select name="martialStatus" class="form-control" required/>
                          <option>Single</option>
                          <option>Married</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-outline-secondary form-control" value="Register Pediatrician" name="register" onclick="this.form.classList.add('was-validated')">
                </form>
           <?php   
   if(isset($_POST['register'])){
    $id = $_POST['id'];
    $names = $_POST['names'];
    $age = $_POST['age'];
    $qualification = $_POST['qualification'];
    $m_Status = $_POST['martialStatus'];

    // Check if the ID already exists
    $sqlCheck = "SELECT * FROM employees WHERE ID='$id'";
    $queryCheck = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($queryCheck) > 0) {
        echo "<script>alert('Pediatrician with that ID already exists')</script>";
    } else {
       
        $sqlInsert = "INSERT INTO employees (ID, NAMES, AGE, QUALIFIATION, Martial_Status) 
                      VALUES ('$id', '$names', '$age', '$qualification', '$m_Status')";
        $queryInsert = mysqli_query($conn, $sqlInsert);

        if ($queryInsert) {
            echo "<script>alert('Pediatrician registered successfully')</script>";
        } else {
            echo "<script>alert('Pediatrician registration failed')</script>";
        }
    }
}
?>

      </div>
    </div>
  </div>
</div>


<!-- Pediatricianists view all Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        &nbsp;<h1 class="modal-title fs-5" id="exampleModalLabel"><p style="font-family:roboto;"><i class="fas fa-list me-1"></i>&nbsp;List of Pediatricianists</p></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Now, let's retrieve and display the table
$sql = "SELECT * FROM employees WHERE ID LIKE 'BH0%'";
$querying = mysqli_query($conn, $sql);

echo "<table class='table table-striped'><tr><th>#</th><th>ID</th><th>Names</th><th>Age</th><th>Qualification</th><th>Martial Status</th><th>Action</th></tr>";

if (mysqli_num_rows($querying) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($querying)) {
        echo "<tr><td>".$i++."</td><td>". $row['ID']."</td><td>".$row['NAMES']."</td><td>". $row['AGE']."</td><td>". $row['QUALIFIATION']."</td><td>". $row['Martial_Status']."</td><td>
        <a href='pediatrician_delete.php?id=".$row['ID']."' class='btn btn-danger btn-sm' onClick=\"return confirm('Are you sure you want to delete this Pediatrician?');\"><i class='fas fa-trash text-light'>&nbsp;&nbsp;</i>Delete</a></td><tr>";
    }

}
echo "</table>";
?>
      </div>
    </div>
  </div>
</div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-info">
                <?php echo isset($_SESSION['visitors']) ? $_SESSION['visitors'] : 0; ?>

                    </h3>
                    <p class="mb-0">Site Visits</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-eye text-info fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
    <div class="progress mt-3 mb-1 rounded" style="height: 7px">
        <?php
        // Get the value from the $_SESSION['visitors'] variable
        $progressValue = isset($_SESSION['visitors']) ? $_SESSION['visitors'] : 0;
        ?>
        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $progressValue; ?>%" aria-valuenow="<?php echo $progressValue; ?>"
            aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>

              </div>
            </div>
          </div>

  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card  card-item">
      <div class="card-body" style="height: 160px;">
        <div class="d-flex justify-content-between p-md-1">
          <div class="d-flex flex-row">
            <div class="card-item">
               <canvas id="viewsChart" width="600" height="100"></canvas>
                <script src="views.js"></script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
   
  </div>
</div>

        <div class="card mb-3" style="height:auto;">
          <div class="card-header py-3 d-flex justify-content-between">
      <h5 class="mb-0 ">

  <nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item active" aria-current="page">
      <span class="page-link"><i class="fas fa-window-restore me-1"></i>&nbsp;Date Pick</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
  </ul>
</nav>
</h5>
<strong class="text-secondary"><i class="fas fa-list-alt me-1 text-primary">&nbsp;&nbsp; </i>Academic year 2023</strong>
<strong><i class="fas fa-th-list me-1 text-warning">&nbsp;&nbsp; </i>Hospitality Calendar</strong>
          </div>
          <div class="card-body">
    <div id="calendar" style="width: auto; min-height: 500px; max-height: 4000px;" ></div>

          </div>
        </div>
      </section>
     
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
        }, 500000); // 20,000 milliseconds (20 seconds)
    </script>

<script>
// calender scripts
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>


  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>