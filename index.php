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

if (isset($_POST['Login'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $privilege = $_POST['privilege'];

    $sql = "SELECT * FROM users WHERE Username='$username'";
  
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $storedPassword = $row['Password'];
        $role = $row['Role'];

        $_SESSION['user_name'] = $username;

        // Verify the entered password against the stored hash
        if (password_verify($password, $storedPassword)) {
            if ($privilege === $role) { // Use strict comparison to ensure an exact match
                if ($privilege === "Admin") {
                    header("location: Admin.php?username=$username"); // Redirect to Admin page
                } elseif ($privilege === "Pediatrician") {
                    header("location: dashboard.php?username=$username"); // Redirect to Dashboard page
                }
            } else {
                echo "<script>alert('Sorry, you do not have the necessary privileges.')</script>";
            }
        } else {
            echo "<script>alert('Incorrect Password')</script>";
        }
    } else {
        echo "<script>alert('User not found')</script>";
    }
}
?>




<html>
<head>
  <title>Welcome to EVS</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
  
  <link href="images/apple-touch-icon.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
  <style>
    body, h1 {
      font-family: "Raleway", Open+Sans:ital;
    }
    body, html {
      height: 100%;
      margin: 0;
    }
    .bgimg {
      background-image: url('images/vax.webp');
      min-height: 100%;
      background-position: center;
      background-size: cover;
      position: relative;
    }
    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
    }
    .content {
      position: relative;
      z-index: 1;
    }
    .copyright {
      position: absolute;
      bottom: 10px;
      left: 10px;
      color: #fff;
    }
    /* Fade-in and move animation */
    .fade-in-move {
      animation: fadeInMove 2s ease-in-out;
    }
    @keyframes fadeInMove {
      from {
        opacity: 0;
        transform: translate(0, -20px);
      }
      to {
        opacity: 1;
        transform: translate(0, 0);
      }
    }
  </style>
</head>
<body>
<div class="bgimg">
  <div class="overlay">
     </div>
  <div class="w3-display-topleft w3-padding-large w3-xlarge text-white content fade-in-move"><br>
    <h1 class="w3-jumbo w3-animate-top" style="font-size: 20px;">&nbsp; &nbsp; &nbsp;<img src="images/apple-touch-icon.png" width="25px"> &nbsp;E-VaxCare System</h1>
  </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <div class="w3-display-middle text-center content fade-in-move">
    <h2 class="w3-jumbo w3-animate-top text-ligt" style="font-size: 55px;color:lightcyan;">WELCOME TO EVS</h2>
    <p class="w3-medium w3-center text-white fade-in-move" style="font-size: 20px;"><small>All child Vaccinations Made easy</small></p>
    <div class="d-flex justify-content-center">
      <button class="btn btn-outline-light rounded-pill mr-3 col-3 col-sm-1 mr-3 fade-in-move" data-bs-toggle="modal" data-bs-target="#exampleModal">Sign Up</button> &nbsp;&nbsp;
      <button class="btn btn-outline-light rounded-pill ml-3 col-3 col-sm-1 ml-3 fade-in-move" data-bs-toggle="modal" data-bs-target="#exampleModalsignup">Login</button>
    </div>
  </div>

  <div class="position-absolute bottom-0 start-0 text-white p-3">
    Byumba Health Center</Center>&nbsp;&copy; 2023 &nbsp; All rights reserved.
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <small>Create an account to access this application</small><br>
         <form method="POST" class="form-control"> 
          <div class="mb-3">
        <label for="privilege" class="form-label">Pediatrician Id</label>
         <input type="text" class="form-control" id="adminUsername" placeholder="Enter your ID" name="P_id">
        </div>
        <div class="mb-3">
          <label for="adminUsername" class="form-label">Choose Username</label>
          <input type="text" class="form-control" id="adminUsername" placeholder="Enter your username" name="username">
        </div>
        <div class="mb-3">
          <label for="adminPassword" class="form-label">Choose Password</label>
          <input type="password" class="form-control" id="adminPassword" placeholder="Enter your password" name="password">
        </div>
        <div class="mb-3">
          <label for="adminPassword" class="form-label">Re-type Password</label>
          <input type="password" class="form-control" id="adminPassword" placeholder="Enter your password" name="re_password">
        </div>
         <input type="submit" class="btn btn-primary form-control mt-3" value="Sign Up" name="signup">
         <input type="button" class="btn btn-danger form-control mt-3" value="Cancel" name="Login" data-bs-dismiss="modal" aria-label="Close">
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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {
    $id = $_POST['P_id'];
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $repassword = $_POST['re_password']; // Re-typed password

    // Check if any field is empty
    if (empty($id) || empty($new_username) || empty($new_password) || empty($repassword)) {
        echo "<script>alert('All fields are required')</script>";
    } else {
        // Check if the Pediatrician ID starts with 'BH00'
        if (substr($id, 0, 3) !== 'BH0') {
            echo "<script>alert('The Pediatrician ID must start with BH00 (e.g., BH001)')</script>";
        } else {
            // Check if the pediatrician ID exists
            $sqli = "SELECT * FROM employees WHERE ID='$id'";
            $query = mysqli_query($conn, $sqli);

            if (mysqli_num_rows($query) > 0) {
                // If ID exists, fetch the ID
                $row = mysqli_fetch_assoc($query);
                $p_id = $row['ID'];

                // Check if an account with the same ID already exists
                $checkAccount = "SELECT * FROM users WHERE ID='$p_id'";
                $accountQuery = mysqli_query($conn, $checkAccount);

                if (mysqli_num_rows($accountQuery) > 0) {
                    echo "<script>alert('An account with this ID already exists')</script>";
                } else {
                    // Check if passwords match and meet strength requirements
                    if ($new_password === $repassword && preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/', $new_password)) {
                        // Insert data into the 'users' table
                        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                        $user_desc = "Pediatrician";
                        $sql = "INSERT INTO users (ID, Username, Password, Role) VALUES ('$p_id', '$new_username', '$hashedPassword', '$user_desc')";
                        $queryy = mysqli_query($conn, $sql);

                        if ($queryy) {
                            echo "<script>alert('Account has been successfully created')</script>";
                        } else {
                            echo "<script>alert('Account Creation Failed')</script>";
                        }
                    } else {
                        echo "<script>alert('Passwords do not match or check if the password contains at least one digit, one uppercase letter, one lowercase letter, one special character, and is at least 8 characters long')</script>";
                    }
                }
            } else {
                echo "<script>alert('Pediatrician ID was not found')</script>";
            }
        }
    }
}
?>



      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalsignup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <small>Provide information below to continue</small>
<form method="POST" class="form-control"> 
  <div class="mb-3">
    <label for="privilege" class="form-label">Login As</label>
    <select class="form-control" name="privilege" id="loginAsSelect" onchange="toggleResetPasswordLink()">
      <option>Admin</option>
      <option>Pediatrician</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="adminUsername" class="form-label">Username</label>
    <input type="text" class="form-control" id="adminUsername" placeholder="Enter your username" name="user">
  </div>
  <div class="mb-3">
    <label for="adminPassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="adminPassword" placeholder="Enter your password" name="pass">
  </div>
  <a href="#" class="justify-content-right" data-bs-toggle="modal" data-bs-target="#exampleModalreset" style="text-decoration: none;" id="resetPasswordLink">Reset Password?</a>
  <input type="submit" class="btn btn-primary form-control mt-3" value="Login" name="Login">
</form>

<script>
function toggleResetPasswordLink() {
  const loginAsSelect = document.getElementById('loginAsSelect');
  const resetPasswordLink = document.getElementById('resetPasswordLink');

  if (loginAsSelect.value === 'Admin') {
    resetPasswordLink.style.display = 'none'; // Hide the link
  } else {
    resetPasswordLink.style.display = 'block'; // Show the link
  }
}

// Initially, call the function to set the initial state based on the default selection
toggleResetPasswordLink();
</script>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalreset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" class="form-control" onsubmit="return validateForm();">
    <div class="mb-3">
        <label for="pediatricianID" class="form-label">Pediatrician ID</label>
        <input type="text" class="form-control" id="pediatricianID" placeholder="Enter your ID" name="P_ID" required>
    </div>
    <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <input type="password" class="form-control" id="newPassword" placeholder="Enter your new password" name="New_P" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$">
        <!-- Password pattern: At least 8 characters, one uppercase letter, one lowercase letter, and one digit -->
    </div>
    <div class="mb-3">
        <label for="retypePassword" class="form-label">Re-type Password</label>
        <input type="password" class="form-control" id="retypePassword" placeholder="Re-type your password" name="re-type_P" required>
    </div>
    <input type="submit" class="btn btn-primary form-control mt-3" value="Reset Password" name="reset">
</form>

      </div>
    </div>
  </div>
</div>

<?php
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

if (isset($_POST['reset'])) {
    $ID = $_POST['P_ID'];
    $newp = $_POST['New_P'];
    $rps = $_POST['re-type_P'];

    // Check if the Pediatrician ID exists in the 'users' table
    $sql = "SELECT * FROM users WHERE ID='$ID'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        // The Pediatrician ID exists

        if ($newp == $rps) {
            // Passwords match, update the password
            $hashedPassword = password_hash($newp, PASSWORD_DEFAULT); // Hash the new password

            $updateSql = "UPDATE users SET Password='$hashedPassword' WHERE ID='$ID'";
            $updateQuery = mysqli_query($conn, $updateSql);

            if ($updateQuery) {
                echo "<script>alert('Password successfully reset')</script>";
            } else {
                echo "<script>alert('Password reset failed')</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match')</script>";
        }
    } else {
        echo "<script>alert('Incorrect Pediatrician ID')</script>";
    }
}
?>

<script>
function validateForm() {
    var newPassword = document.getElementById("newPassword").value;
    var retypePassword = document.getElementById("retypePassword").value;
    
    // Check if passwords match
    if (newPassword !== retypePassword) {
        alert("Passwords do not match");
        return false;
    }
    
    // Check if the password meets the pattern requirements
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwordPattern.test(newPassword)) {
        alert("Password must contain at least 8 characters, one uppercase letter, one lowercase letter, and one digit");
        return false;
    }
    
    // Form is valid, allow submission
    return true;
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
