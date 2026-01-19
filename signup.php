<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'cards-order') or die(mysqli_error());

if (isset($_POST['submit'])) {

    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $password  = md5($_POST['password']);
    $role      = 'user'; // DEFAULT ROLE

    // Check duplicate username
    $check = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['msg'] = "Username already exists!";
        header("Location: register.php");
        exit;
    }

    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password',
            role='$role'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "Registered successfully!";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['msg'] = "Registration failed!";
        header("Location: register.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
}

body{
  min-height:100vh;
  background:linear-gradient(135deg,#e0eafc,#cfdef3);
  display:flex;
  align-items:center;
  justify-content:center;
}

.card{
  background:#fff;
  width:100%;
  max-width:420px;
  padding:30px;
  border-radius:12px;
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.card h2{
  text-align:center;
  margin-bottom:20px;
  color:#333;
}

.alert{
  background:#f8d7da;
  color:green;
  padding:10px;
  border-radius:6px;
  font-size:14px;
  margin-bottom:15px;
  text-align:center;
}

.success{
  background:#d4edda;
  color:#155724;
}

.form-group{
  margin-bottom:15px;
}

label{
  font-size:14px;
  color:#555;
  margin-bottom:5px;
  display:block;
}

input{
  width:100%;
  padding:12px;
  border:1px solid #ccc;
  border-radius:6px;
  font-size:14px;
}

input:focus{
  border-color:#4a90e2;
  outline:none;
}

.btn{
  width:100%;
  padding:12px;
  border:none;
  background:#4a90e2;
  color:#fff;
  font-size:15px;
  border-radius:6px;
  cursor:pointer;
  margin-top:10px;
  transition:0.3s;
}

.btn:hover{
  background:#357abd;
}

.footer{
  text-align:center;
  margin-top:15px;
  font-size:13px;
}

.footer a{
  color:#4a90e2;
  text-decoration:none;
  font-weight:500;
}
.back-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    background: black;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s ease;
    z-index: 1000;
}

.back-btn:hover {
    background: #732d91;
}  
</style>
</head>

<body>
       <button class="back-btn" onclick="window.location.href='login.php'">← Back</button>


<div class="card">
  <h2>Register</h2>

  <?php
  if (isset($_SESSION['msg'])) {
      echo '<div class="alert">'.$_SESSION['msg'].'</div>';
      unset($_SESSION['msg']);
  }
  ?>

  <form method="POST">
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="full_name" required>
    </div>

    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" required>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>

    <button type="submit" name="submit" class="btn">Register</button>
  </form>

  <div class="footer">
    Already have an account? <a href="login.php">Login</a>
  </div>
</div>

</body>
</html>
